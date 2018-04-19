<?php
/**
 * This file is part of MilaLevchuk.ru project (https://milalevchuk.ru/)
 *
 * Copyright (c) 2018 IE Levchuk Lyudmila Nikolaevna.
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
/* @var xPDOObject[] $menus */


$menus[1] = $modx->newObject('modMenu');
$menus[1]->fromArray( array (
  'text' => 'redissession_flush',
  'parent' => 'manage',
  'description' => 'redissession_flush_desc',
  'icon' => '',
  'menuindex' => 0,
  'params' => '',
  'handler' => 'MODx.msg.confirm({
    title: _(\'flush_sessions\')
    ,text: _(\'flush_sessions_confirm\')
    ,url: MODx.config.assets_url + \'components/redissession/connector.php\'
    ,params: {
        action: \'mgr/flush\'
    }
    ,listeners: {
        \'success\': {fn:function() { location.href = \'./\'; },scope:this}
    }
});',
  'permissions' => 'flush_sessions',
  'namespace' => 'redissession',
  'id' => 1,
), '', true, true);

return $menus;
