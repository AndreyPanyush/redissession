<?php
/**
 * en default topic lexicon file for RedisSession extra
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
 *
 * @package redissession
 */

/**
 * Description
 * -----------
 * en default topic lexicon strings
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package redissession
 **/


/* Used in transport.menus.php */
$_lang['redissession_flush'] = 'RedisSession: Logout All Users';
$_lang['redissession_flush_desc'] = 'Immediately destroy all sessions stored in Redis';
$_lang['redissession_flush_sessions'] = 'RedisSession: Logout All Users';
$_lang['redissession_flush_sessions_confirm'] = 'Are you sure you want to flush all user sessions? This will destroy all current and recent user sessions.';
$_lang['redissession_flush_sessions_err'] = 'An error occured while attempting to flush the current user sessions.';
$_lang['redissession_flush_sessions_not_supported'] = 'Flushing user sessions is not supported on your configuration.';

/* Used in transport.settings.php */
$_lang['setting_redissession_connection_timeout'] = 'Redis connection timeout';
$_lang['setting_redissession_connection_timeout_desc'] = 'The connection timeout to a redis host';
$_lang['setting_redissession_lock_timeout'] = 'Session lock timeout';
$_lang['setting_redissession_lock_timeout_desc'] = 'The session lock timeout';
$_lang['setting_redissession_spin_lock_wait'] = 'Session spin lock wait';
$_lang['setting_redissession_spin_lock_wait_desc'] = 'Timeout between attempts to access session';
$_lang['setting_redissession_prefix'] = 'Redis key prefix';
$_lang['setting_redissession_prefix_desc'] = 'IMPORTANT: if you will use empty prefix you can damage other keys in storage';
$_lang['setting_redissession_server'] = 'Redis host';
$_lang['setting_redissession_server_desc'] = '';
$_lang['setting_redissession_port'] = 'Redis port';
$_lang['setting_redissession_port_desc'] = '';
$_lang['setting_redissession_db'] = 'Redis database';
$_lang['setting_redissession_db_desc'] = '';
$_lang['setting_redissession_password'] = 'Redis password';
$_lang['setting_redissession_password_desc'] = '';