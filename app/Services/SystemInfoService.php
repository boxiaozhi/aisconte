<?php
namespace App\Services;

use mysqli;

class SystemInfoService
{
    public function all(){
        $types = ['OS', 'PHP', 'Service', 'Database', 'Laravel'];
        $data = [];
        foreach($types as $type){
            $functionName = strtolower($type);
            $data[$type] = $this->$functionName();
        }
        return $data;
    }

    public function __call($name, $args=[]){
        if(method_exists($this, $name)){
            return $this->$name();
        }
        return [];
    }

    private function os()
    {
        $data = [
            'uname' => php_uname(),
        ];
        return $data;
    }

    private function php()
    {
        $data = [
            'version' => 'PHP/' . PHP_VERSION,
            'CGI'     => php_sapi_name(),
        ];
        return $data;
    }

    private function service()
    {
        $data = [
            'name' => array_get($_SERVER, 'SERVER_SOFTWARE'),
        ];
        return $data;
    }

    private function database()
    {
        $data = [
            'mysql' => [
                'version' => $this->mysqlInfo(),
                ],
            'redis' => '',
        ];
        return $data;
    }

    private function laravel()
    {
        $data = [
            'version'        => app()->version(),
            'timezone'       => config('app.timezone'),
            'locale'         => config('app.locale'),
            'env'            => config('app.env'),
            'cache driver'   => config('cache.default'),
            'session driver' => config('session.driver'),
            'Queue driver'   => config('queue.default')
        ];
        return $data;
    }

    private function mysqlInfo()
    {
        $host     = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $mysqli   = new mysqli($host, $username, $password);
        return $mysqli->server_info;
    }
}