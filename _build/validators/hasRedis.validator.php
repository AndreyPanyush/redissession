<?php
/**
 * Validator for RedisSession extra
 *
 * Copyright 2018 by Andrey Panyush <andreypanyush@gmail.com>
 * Created on 03-08-2018
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
 * @package redissession
 * @subpackage build
 */

/* @var $object xPDOObject */
/* @var $modx modX */
/* @var array $options */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            if(!extension_loaded("redis")) {
                $modx->log(modX::LOG_LEVEL_ERROR, '[Redis validator] phpredis is not installed. See https://github.com/phpredis/phpredis');
                return false;
            }
            break;
        case xPDOTransport::ACTION_UPGRADE:
            if(!extension_loaded("redis")) {
                $modx->log(modX::LOG_LEVEL_ERROR, '[Redis validator] phpredis is not installed. See https://github.com/phpredis/phpredis');
                return false;
            }
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;