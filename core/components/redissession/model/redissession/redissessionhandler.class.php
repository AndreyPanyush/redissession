<?php
/**
 * RedisSession's session handler
 *
 * Based on RedisSessionHandler by dmitry-suffi <https://github.com/dmitry-suffi/redis-session-handler>
 *
 * Copyright 2018 by Andrey Panyush <andrey.panyush@gmail.com>
 *
 * This file is part of RedisSession.
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * @package redissession
 */
class RedisSessionHandler extends \SessionHandler {
    /**
     * @var modX
     */
    protected $modx;
    /**
     * @var Redis
     */
    protected $redis;
    /**
     * @var int
     */
    protected $ttl;
    /**
     * @var int
     */
    protected $prefix;
    /**
     * @var bool
     */
    protected $locked;
    /**
     * @var null
     */
    private $lockKey;
    /**
     * @var
     */
    private $token;
    /**
     * @var int
     */
    private $spinLockWait;
    /**
     * @var int
     */
    private $lockMaxWait;

    /**
     * RedisSessionHandler constructor.
     * @param modX $modx
     */
    public function __construct(modX $modx) {
        ini_set('session.serialize_handler', 'php_serialize');
        session_set_save_handler(
            array(&$this, 'open'),
            array(&$this, 'close'),
            array(&$this, 'read'),
            array(&$this, 'write'),
            array(&$this, 'destroy'),
            array(&$this, 'gc'),
            array(&$this, 'create_sid')
        );
        $this->modx = &$modx;
        $connection_timeout = (integer) $this->modx->getOption('redissession_connection_timeout', null, 0);

        $lock_timeout = (integer) $this->modx->getOption('redissession_lock_timeout', null, 20);
        if ($lock_timeout > 0) {
            $this->lockMaxWait = $lock_timeout;
        } else {
            $this->lockMaxWait = ((integer) @ini_get('max_execution_time')) * 0.7;
        }
        $gc_max_lifetime = (integer) $this->modx->getOption('session_gc_maxlifetime');
        if ($gc_max_lifetime > 0) {
            $this->ttl = $gc_max_lifetime;
        } else {
            $this->ttl = (integer) @ini_get('session.gc_maxlifetime');
        }
        $this->spinLockWait = (integer) $this->modx->getOption('redissession_spin_lock_wait', null, 200000);
        $this->prefix = $this->modx->getOption('redissession_prefix', null, 'PHPREDIS_SESSION:');

        $this->redis = new Redis();
        $this->modx->redisSession_redis = &$this->redis;
        $this->redis->pconnect($this->modx->getOption('redissession_server'), $this->modx->getOption('redissession_port', null, 6379), $connection_timeout);
        if($this->modx->getOption('redissession_password') !== false) $this->redis->auth($this->modx->getOption('redissession_password'));
        if($this->modx->getOption('redissession_db') !== false) $this->redis->select($this->modx->getOption('redissession_db'));

        $this->locked = false;
        $this->lockKey = null;
    }

    /**
     * Doing nothing
     *
     * @param string $savePath
     * @param string $sessionName
     * @return bool
     */
    public function open($savePath, $sessionName) {
        return true;
    }

    /**
     * Lock session by creating additional key with ".lock" postfix
     *
     * @param $sessionId
     * @return bool
     */
    protected function lockSession($sessionId) {
        $attempts = (1000000 * $this->lockMaxWait) / $this->spinLockWait;
        $this->token = uniqid();
        $this->lockKey = $sessionId . '.lock';
        for ($i = 0; $i < $attempts; ++$i) {
            $success = $this->redis->set(
                $this->getRedisKey($this->lockKey),
                $this->token,
                [
                    'NX',
                ]
            );
            if ($success) {
                $this->locked = true;
                return true;
            }
            usleep($this->spinLockWait);
        }
        return false;
    }

    /**
     * Unlock session
     */
    private function unlockSession() {
        $script = <<<LUA
if redis.call("GET", KEYS[1]) == ARGV[1] then
    return redis.call("DEL", KEYS[1])
else
    return 0
end
LUA;
        $this->redis->eval($script, array($this->getRedisKey($this->lockKey), $this->token), 1);
        $this->locked = false;
        $this->token = null;
    }

    /**
     * Close and unlock session
     *
     * @return bool
     */
    public function close() {
        if ($this->locked) {
            $this->unlockSession();
        }
        return true;
    }

    /**
     * Read data from Redis
     *
     * @param string $sessionId
     * @return bool|string
     */
    public function read($sessionId) {
        if (!$this->locked) {
            if (!$this->lockSession($sessionId)) {
                return false;
            }
        }
        return $this->redis->get($this->getRedisKey($sessionId)) ?: '';
    }

    /**
     * Write data into Redis
     *
     * @param string $sessionId
     * @param string $data
     * @return bool
     */
    public function write($sessionId, $data) {
        if ($this->ttl > 0) {
            $this->redis->setex($this->getRedisKey($sessionId), $this->ttl, $data);
        } else {
            $this->redis->set($this->getRedisKey($sessionId), $data);
        }
        return true;
    }

    /**
     * Delete specified session
     *
     * @param string $sessionId
     * @return bool
     */
    public function destroy($sessionId) {
        $this->redis->del($this->getRedisKey($sessionId));
        $this->close();
        return true;
    }

    /**
     * Always return true. Doing nothing
     *
     * @param int $lifetime
     * @return bool
     */
    public function gc($lifetime) {
        return true;
    }

    /**
     * @return float|int
     */
    public function getLockMaxWait() {
        return $this->lockMaxWait;
    }

    /**
     * @param $lockMaxWait
     */
    public function setLockMaxWait($lockMaxWait) {
        $this->lockMaxWait = $lockMaxWait;
    }

    /**
     * @param $key
     * @return string
     */
    protected function getRedisKey($key) {
        if (empty($this->prefix)) {
            return $key;
        }
        return $this->prefix . $key;
    }

    /**
     * Generate custom session_id
     * @link http://php.net/manual/en/sessionhandler.create-sid.php
     * @return string <p>A session ID valid for the default session handler.</p>
     * @since 5.5.1
     */
    public function create_sid() {
        $sid = $this->modx->invokeEvent('onRedisSessionIdRequest', array(
            'handler' => &$this
        ));
        if(is_array($sid) && isset($sid[0])) $sid = $sid[0];
        else $sid = null;

        if(!$sid) return parent::create_sid();
        return $sid;
    }

    /**
     * RedisSessionHandler destructor
     */
    public function __destruct()
    {
        $this->close();
    }
}