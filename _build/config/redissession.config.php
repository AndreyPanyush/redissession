<?php

 /*               DO NOT EDIT THIS FILE

  Edit the file in the MyComponent config directory
  and run ExportObjects

 */


$packageNameLower = 'redissession';

$components = array(
    'packageName' => 'RedisSession',
    'packageNameLower' => $packageNameLower,
    'packageDescription' => 'Provide session management over Redis',
    'version' => '0.1.3',
    'release' => 'pl',
    'author' => 'Andrey Panyush',
    'email' => '<andreypanyush@gmail.com>',
    'copyright' => '2018',

    'createdon' => strftime('%m-%d-%Y'),

    'gitHubUsername' => 'AndreyPanyush',
    'gitHubRepository' => 'RedisSession',

    'primaryLanguage' => 'en',

    'dirPermission' => 0755,
    'filePermission' => 0644,

    'mycomponentRoot' => $this->modx->getOption('mc.root', null,
        MODX_CORE_PATH . 'components/mycomponent/'),

    'targetRoot' => MODX_ASSETS_PATH . 'mycomponents/' . $packageNameLower . '/',


    /* *********************** NEW SYSTEM SETTINGS ************************ */

    /* If your extra needs new System Settings, set their field values here.
     * You can also create or edit them in the Manager (System -> System Settings),
     * and export them with exportObjects. If you do that, be sure to set
     * their namespace to the lowercase package name of your extra */

    'newSystemSettings' => array(
        'redissession_connection_timeout' => array(
            'key' => 'redissession_connection_timeout',
            'name' => 'redissession_connection_timeout',
            'description' => 'redissession_connection_timeout_description',
            'namespace' => 'redissession',
            'xtype' => 'textfield',
            'value' => '0',
            'area' => 'redissession.main',
        ),
        'redissession_lock_timeout' => array(
            'key' => 'redissession_lock_timeout',
            'name' => 'redissession_lock_timeout',
            'description' => 'redissession_lock_timeout_description',
            'namespace' => 'redissession',
            'xtype' => 'textfield',
            'value' => '20',
            'area' => 'redissession.main',
        ),
        'redissession_spin_lock_wait' => array(
            'key' => 'redissession_spin_lock_wait',
            'name' => 'redissession_spin_lock_wait',
            'description' => 'redissession_spin_lock_wait_description',
            'namespace' => 'redissession',
            'xtype' => 'textfield',
            'value' => '200000',
            'area' => 'redissession.main',
        ),
        'redissession_prefix' => array(
            'key' => 'redissession_prefix',
            'name' => 'redissession_prefix',
            'description' => 'redissession_prefix_description',
            'namespace' => 'redissession',
            'xtype' => 'textfield',
            'value' => 'PHPREDIS_SESSION:',
            'area' => 'redissession.main',
        ),
        'redissession_server' => array(
            'key' => 'redissession_server',
            'name' => 'redissession_server',
            'description' => 'redissession_server_description',
            'namespace' => 'redissession',
            'xtype' => 'textfield',
            'value' => '127.0.0.1',
            'area' => 'redissession.main',
        ),
        'redissession_port' => array(
            'key' => 'redissession_port',
            'name' => 'redissession_port',
            'description' => 'redissession_port_description',
            'namespace' => 'redissession',
            'xtype' => 'textfield',
            'value' => '6379',
            'area' => 'redissession.main',
        ),
        'redissession_db' => array(
            'key' => 'redissession_db',
            'name' => 'redissession_db',
            'description' => 'redissession_db_description',
            'namespace' => 'redissession',
            'xtype' => 'textfield',
            'value' => '0',
            'area' => 'redissession.main',
        ),
        'redissession_password' => array(
            'key' => 'redissession_password',
            'name' => 'redissession_password',
            'description' => 'redissession_password_description',
            'namespace' => 'redissession',
            'xtype' => 'text-password',
            'value' => '',
            'area' => 'redissession.main',
        ),
        'redissession_serialize_handler' => array(
            'key' => 'redissession_serialize_handler',
            'name' => 'redissession_serialize_handler',
            'description' => 'redissession_serialize_handler_description',
            'namespace' => 'redissession',
            'xtype' => 'textfield',
            'value' => '',
            'area' => 'redissession.main',
        ),
    ),

    'newSystemEvents' => array(
        'onRedisSessionIdRequest' => array(
            'name' => 'onRedisSessionIdRequest',
            'groupname' => 'RedisSession',
        ),
    ),

    'namespaces' => array(
        'redissession' => array(
            'name' => 'redissession',
            'path' => '{core_path}components/redissession/',
            'assets_path' => '{assets_path}components/redissession/',
        ),

    ),

    'categories' => array(
        'RedisSession' => array(
            'category' => 'RedisSession',
            'parent' => ''
        )
    ),

    'menus' => array(
        'redissession_flush' => array(
            'text' => 'redissession_flush',
            'parent' => 'manage',
            'description' => 'redissession_flush_desc',
            'icon' => '',
            'menuindex' => 0,
            'params' => '',
            'handler' => "MODx.msg.confirm({
    title: _('flush_sessions')
    ,text: _('flush_sessions_confirm')
    ,url: MODx.config.assets_url + 'components/redissession/connector.php'
    ,params: {
        action: 'mgr/flush'
    }
    ,listeners: {
        'success': {fn:function() { location.href = './'; },scope:this}
    }
});",
            'permissions' => 'flush_sessions',

            'action' => null,
        ),
    ),

    'elements' => array(
        'plugins' => array(
            'RedisSessionSID' => array(
                'category' => 'RedisSession',
                'description' => '',
                'static' => true,
                'events' => array(
                    'onRedisSessionIdRequest' => array(),
                ),
            ),
        )
    ),
    'allStatic' => false,


    'languages' => array(
        'en' => array(
            'default'
        ),
        'ru' => array(
            'default'
        ),
    ),
    /* ********************************************* */
    /* Define optional directories to create under assets.
     * Add your own as needed.
     * Set to true to create directory.
     * Set to hasAssets = false to skip.
     * Empty js and/or css files will be created.
     */
    'hasAssets' => true,

    'assetsDirs' => array(
    ),

    /* ********************************************* */
    /* Define basic directories and files to be created in project*/

    'docs' => array(
        'readme.txt',
        'license.txt',
        'changelog.txt',
        'tutorial.html'
    ),

    /* (optional) Description file for GitHub project home page */
    'readme.md' => true,
    /* assume every package has a core directory */
    'hasCore' => true,


    'resolvers' => array(
        'addExtension',
    ),


    'validators' => array(
        'hasRedis',
    ),

    /*
    'install.options' => 'install.options',
*/

    /* ********************************************* */
    /* (optional) Only necessary if you will have class files.
     *
     * Array of class files to be created.
     *
     * Format is:
     *
     * 'ClassName' => 'directory:filename',
     *
     * or
     *
     *  'ClassName' => 'filename',
     *
     * ('.class.php' will be appended automatically)
     *
     *  Class file will be created as:
     * yourcomponent/core/components/yourcomponent/model/[directory/]{filename}.class.php
     * Note: If a CMP is being created, classes containing the
     * project name will be ignored here.
     *
     * Set to array() if there are no classes. */
    'classes' => array(
        'RedisSession' => 'redissession:redissession'
    ),

    /* ************************************
     *  These values are for CMPs.
     *  Set any of these to an empty array if you don't need them.
     *  **********************************/

    /* If this is false, the rest of this section will be ignored */

    'createCmpFiles' => true,

    /* IMPORTANT: The array values in the rest of
       this section should be all lowercase */

    /* This is the main action file for your component.
       It will automatically go in core/component/yourcomponent/
    */



    /* These will automatically go to core/components/yourcomponent/processors/
       format directory:filename
       '.class.php' will be appended to the filename

       Built-in processor classes include getlist, create, update, duplicate,
       import, and export. */

    'processors' => array(
        'mgr:flush',
    ),


    'connectors' => array(
        'connector.php'

    ),

    'cmpJsFiles' => array(
    ),



    /* *******************************************
     * These settings control exportObjects.php  *
     ******************************************* */
    /* ExportObjects will update existing files. If you set dryRun
       to '1', ExportObjects will report what it would have done
       without changing anything. Note: On some platforms,
       dryRun is *very* slow  */

    'dryRun' => '0',

    /* Array of elements to export. All elements set below will be handled.
     *
     * To export resources, be sure to list pagetitles and/or IDs of parents
     * of desired resources
    */
    'process' => array(
        'plugins',
    //    'systemSettings',
    ),
    'rewriteCodeFiles' => false,  /* remove ~~descriptions */
    'rewriteLexiconFiles' => true,
    'scriptPropertiesAliases' => array(
        'config',
        'scriptProperties'
    ),
);

return $components;