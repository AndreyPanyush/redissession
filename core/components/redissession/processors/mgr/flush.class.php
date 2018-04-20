<?php
/**
 * RedisSession Flush Processor
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
class RedisSessionFlush extends modProcessor {
    /**
     * Check permissions to preform flush action
     *
     * @return bool
     */
    public function checkPermissions() {
        return $this->modx->hasPermission('flush_sessions');
    }

    /**
     * Run processor
     *
     * @return array|string
     */
    public function process() {
        if ($this->modx->getOption('session_handler_class',null,'modSessionHandler') == 'RedisSessionHandler') {
            if (!$this->flushSessions()) {
                return $this->failure($this->modx->lexicon('redissession_flush_sessions_err'));
            }
        } else {
            return $this->failure($this->modx->lexicon('redissession_flush_sessions_not_supported'));
        }
        return $this->success();
    }

    /**
     * Flush
     *
     * @return bool
     */
    public function flushSessions() {
        $prefix = $this->modx->getOption('redissession_prefix', null, 'PHPREDIS_SESSION:');
        if(isset($this->modx->redisSession_redis) && $this->modx->redisSession_redis instanceof Redis) {
            $this->modx->redisSession_redis->eval(<<<LUA
    return redis.call('del', 'redissession_flushPlaceholder', unpack(redis.call('keys', ARGV[1])))
LUA
            , array($prefix . '*'));
            return true;
        }

        return false;
    }
}

return 'RedisSessionFlush';