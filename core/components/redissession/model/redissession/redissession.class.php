<?php
/**
 * The base class for RedisSession
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
class RedisSession {
    /**
     * @var Redis
     */
    public $redis;

    /**
     * RedisSession constructor.
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array()) {
        $this->modx = &$modx;

        $corePath = $this->modx->getOption('redissession.core_path', $config, $this->modx->getOption('core_path') . 'components/redissession/');
        $assetsPath = $this->modx->getOption('redissession.assets_path', $config, $this->modx->getOption('assets_path') . 'components/redissession/');
        $assetsUrl = $this->modx->getOption('redissession.assets_url', $config, $this->modx->getOption('assets_url') . 'components/redissession/');
        $connectorUrl = $assetsUrl . 'connector.php';

        $this->config = array_merge(array(
            'assetsUrl' => $assetsUrl,

            'connectorUrl' => $connectorUrl,

            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'pluginsPath' => $corePath . 'elements/plugins/',
            'processorsPath' => $corePath . 'processors/',
        ), $config);

        $this->modx->addPackage('redissession', $this->config['modelPath']);
    }
}