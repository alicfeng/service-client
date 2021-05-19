<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 */

namespace Samego\Client;

use Samego\Client\Supports\Http\Request as Http;

/**
 * Class ServiceClient
 * 服务调用客户端容器.
 * @method static Http http()
 */
class ServiceClient
{
    /**
     * @description make application container(obj)
     * @param string $name 应用名称
     * @return mixed
     * @author      AlicFeng
     */
    private static function make(string $name)
    {
        $namespace   = ucfirst($name);
        $application = "Samego\\Client\\Supports\\{$namespace}\\{Request}";

        return app($application);
    }

    /**
     * @description dynamically pass methods to the application
     * @param string $name
     * @param array  $arguments
     * @return mixed
     * @author      AlicFeng
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name);
    }
}
