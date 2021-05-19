<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 */

namespace Samego\Client\Facades;

use Illuminate\Support\Facades\Facade;
use Samego\Client\Contracts\HttpRequestInterface;
use Samego\Client\Supports\Http\Request;
use Samego\Response\Response;

/**
 * Class ServiceHttpClient
 * todo describe ...
 * @method static Request service(string $name)
 * @method static Request package(array $package = [])
 * @method static Request headers(array $headers = [])
 * @method static Request uri(string $uri)
 * @method static Response request()
 * @version 1.0.0
 * @author  AlicFeng
 */
class ServiceHttpClient extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return HttpRequestInterface::class;
    }
}
