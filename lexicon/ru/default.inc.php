    <?php
/**
 * ru default topic lexicon file for RedisSession extra
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
 * ru default topic lexicon strings
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package redissession
 **/


/* Used in transport.menus.php */
$_lang['redissession_flush'] = 'RedisSession: Завершить все сеансы';
$_lang['redissession_flush_desc'] = 'Immediately destroy all sessions stored in Redis';
$_lang['redissession_flush_sessions'] = 'RedisSession: Завершить все сеансы';
$_lang['redissession_flush_sessions_confirm'] = 'Вы уверены, что хотите завершить сеансы всех пользователей? Будут завершены сеансы всех пользователей';
$_lang['redissession_flush_sessions_err'] = 'Произошла ошибка при попытке завершить сеанс текущего пользователя.';
$_lang['redissession_flush_sessions_not_supported'] = 'Завершение сеансов работы пользователей не поддерживается в вашей конфигурации.';

/* Used in transport.settings.php */
$_lang['setting_redissession_connection_timeout'] = 'Таймаут подключения к Redis';
$_lang['setting_redissession_connection_timeout_desc'] = 'Максимальное время для установки соединения с сервером Redis';
$_lang['setting_redissession_lock_timeout'] = 'Время блокировки сессии';
$_lang['setting_redissession_lock_timeout_desc'] = 'Максимально время, на которое может быть установлена блокировка сессии';
$_lang['setting_redissession_spin_lock_wait'] = 'Задержка между повторами';
$_lang['setting_redissession_spin_lock_wait_desc'] = 'Задержка между повторными попытками обращения к сессии';
$_lang['setting_redissession_prefix'] = 'Префикс ключей';
$_lang['setting_redissession_prefix_desc'] = 'ВНИМАНИЕ: не используйте пустой префикс, в противном случае, вы можете повредить другие ключи в хранилище';
$_lang['setting_redissession_server'] = 'Redis-хост';
$_lang['setting_redissession_server_desc'] = '';
$_lang['setting_redissession_port'] = 'Порт Redis';
$_lang['setting_redissession_port_desc'] = '';
$_lang['setting_redissession_db'] = 'Номер базы данных Redis';
$_lang['setting_redissession_db_desc'] = '';
$_lang['setting_redissession_password'] = 'Пароль Redis';
$_lang['setting_redissession_password_desc'] = '';