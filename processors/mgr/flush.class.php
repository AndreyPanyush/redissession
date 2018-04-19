<?php
/**
 * This file is part of MilaLevchuk.ru project (https://milalevchuk.ru/)
 *
 * Copyright (c) 2018 IE Levchuk Lyudmila Nikolaevna.
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