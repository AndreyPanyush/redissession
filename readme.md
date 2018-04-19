RedisSession Extra for MODx Revolution
=======================================

**Author:** Andrey Panyush <andreypanyush@gmail.com> []()

**Based on:** RedisSessionHandler by dmitry-suffi <https://github.com/dmitry-suffi/redis-session-handler>

Provide session management over Redis


<h3>Minimum System Requirements</h3>
<ul>
    <li>modx-2.2.0</li>
    <li>phpredis-3.0.0</li>
    <li>php-5.5.1 for custom session id</li>
</ul>
<h3>Installing RedisSession</h3>

<p>
Go to System | Package Management on the main menu in the MODX Manager and click on the &quot;Download Extras&quot; button. That will take you to the
Revolution Repository (AKA Web Transport Facility). Put RedisSession in the search box and press Enter. Click on the &quot;Download&quot; button, and once the package is downloaded,
 click on the &quot;Back to Package Manager&quot; button. That should bring you back to your Package Management grid. Click on the
&quot;Install&quot; button next to RedisSession in the grid. The RedisSession package should now be installed.</p>

<h3>Usage</h3>
<ol>
    <li>Go to System Settings</li>
    <li>Select "redissession" namespace</li>
    <li>Set redissession_host, redissession_port, redissession_database and redissession_password to yours</li>
    <li>CLEAR SITE CACHE!</li>
    <li>Select "core" namespace, then select "Session and Cookie" area</li>
    <li>Set session_handler_class to "RedisSessionHandler"</li>
    <li>Clear cache again</li>
</ol>