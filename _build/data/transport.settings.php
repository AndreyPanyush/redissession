<?php
/**
 * systemSettings transport file for RedisSession extra
 *
 * Copyright 2018 by Andrey Panyush <andreypanyush@gmail.com>
 * Created on 03-08-2018
 *
 * @package redissession
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1]->fromArray(array (
  'key' => 'redissession_connection_timeout',
  'name' => 'redissession_connection_timeout',
  'description' => 'redissession_connection_timeout_description',
  'namespace' => 'redissession',
  'xtype' => 'textfield',
  'value' => '0',
  'area' => 'redissession.main',
), '', true, true);
$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2]->fromArray(array (
  'key' => 'redissession_lock_timeout',
  'name' => 'redissession_lock_timeout',
  'description' => 'redissession_lock_timeout_description',
  'namespace' => 'redissession',
  'xtype' => 'textfield',
  'value' => '20',
  'area' => 'redissession.main',
), '', true, true);
$systemSettings[3] = $modx->newObject('modSystemSetting');
$systemSettings[3]->fromArray(array (
  'key' => 'redissession_spin_lock_wait',
  'name' => 'redissession_spin_lock_wait',
  'description' => 'redissession_spin_lock_wait_description',
  'namespace' => 'redissession',
  'xtype' => 'textfield',
  'value' => '200000',
  'area' => 'redissession.main',
), '', true, true);
$systemSettings[4] = $modx->newObject('modSystemSetting');
$systemSettings[4]->fromArray(array (
  'key' => 'redissession_prefix',
  'name' => 'redissession_prefix',
  'description' => 'redissession_prefix_description',
  'namespace' => 'redissession',
  'xtype' => 'textfield',
  'value' => 'PHPREDIS_SESSION:',
  'area' => 'redissession.main',
), '', true, true);
$systemSettings[5] = $modx->newObject('modSystemSetting');
$systemSettings[5]->fromArray(array (
  'key' => 'redissession_server',
  'name' => 'redissession_server',
  'description' => 'redissession_server_description',
  'namespace' => 'redissession',
  'xtype' => 'textfield',
  'value' => '127.0.0.1',
  'area' => 'redissession.main',
), '', true, true);
$systemSettings[6] = $modx->newObject('modSystemSetting');
$systemSettings[6]->fromArray(array (
  'key' => 'redissession_port',
  'name' => 'redissession_port',
  'description' => 'redissession_port_description',
  'namespace' => 'redissession',
  'xtype' => 'textfield',
  'value' => '6379',
  'area' => 'redissession.main',
), '', true, true);
$systemSettings[7] = $modx->newObject('modSystemSetting');
$systemSettings[7]->fromArray(array (
  'key' => 'redissession_db',
  'name' => 'redissession_db',
  'description' => 'redissession_db_description',
  'namespace' => 'redissession',
  'xtype' => 'textfield',
  'value' => '0',
  'area' => 'redissession.main',
), '', true, true);
$systemSettings[8] = $modx->newObject('modSystemSetting');
$systemSettings[8]->fromArray(array (
  'key' => 'redissession_password',
  'name' => 'redissession_password',
  'description' => 'redissession_password_description',
  'namespace' => 'redissession',
  'xtype' => 'textfield',
  'value' => '0',
  'area' => 'redissession.main',
), '', true, true);
return $systemSettings;
