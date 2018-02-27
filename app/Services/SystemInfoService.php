<?php
/**
 * 系统信息
 * User: Conte
 * Date: 2018/1/30
 * Time: 06:24
 */

namespace App\Services;


use mysqli;

class SystemInfoService
{
    public function base(){
        $info = [
            //Linux
            ['name' => 'Uname',             'value' => php_uname()],
            //PHP
            ['name' => 'PHP version',       'value' => 'PHP/'.PHP_VERSION],
            ['name' => 'CGI',               'value' => php_sapi_name()],
            //Nginx
            ['name' => 'Server',            'value' => array_get($_SERVER, 'SERVER_SOFTWARE')],
            //Mysql
            ['name'=> 'Database',           'value' =>'MYSQL/'.$this->mysql()],
            //Laravel
            ['name' => 'Laravel version',   'value' => app()->version()],
            ['name' => 'Cache driver',      'value' => config('cache.default')],
            ['name' => 'Session driver',    'value' => config('session.driver')],
            ['name' => 'Queue driver',      'value' => config('queue.default')],

            ['name' => 'Timezone',          'value' => config('app.timezone')],
            ['name' => 'Locale',            'value' => config('app.locale')],
            ['name' => 'Env',               'value' => config('app.env')],
            ['name' => 'URL',               'value' => config('app.url')],
        ];
        return $info;
    }

    public function mysql()
    {
        $host     = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $mysqli   = new mysqli($host, $username, $password);
        return $mysqli->server_info;
    }
}