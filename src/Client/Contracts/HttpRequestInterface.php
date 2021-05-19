<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 */

namespace Samego\Client\Contracts;

use Samego\Client\Response;
use Samego\Client\Supports\Http\Request;

interface HttpRequestInterface
{
    /**
     * @function    service
     * @description 指定服务路由
     * @param string $name 服务路由名称
     * @return Request
     * @datetime    2021/5/19 上午1:07
     * @author      AlicFeng
     */
    public function service(string $name): Request;

    /**
     * @function    package
     * @description 设定报文
     * @param array $package
     * @return Request
     * @datetime    2021/5/19 上午1:08
     * @author      AlicFeng
     */
    public function package(array $package = []): Request;

    /**
     * @function    uri
     * @description 指定请求路由
     * @param string $uri 请求路由
     * @return Request
     * @datetime    2021/5/19 上午1:09
     * @author      AlicFeng
     */
    public function uri(string $uri): Request;

    /**
     * @function    header
     * @description 追加指定头部
     * @param array $headers
     * @return Request
     * @datetime    2021/5/19 上午2:54
     * @author      AlicFeng
     */
    public function header(array $headers = []): Request;

    /**
     * @function    request
     * @description 触发句柄请求
     * @return Response
     * @author      AlicFeng
     * @datatime    2021/5/18 下午2:45
     */
    public function request(): Response;
}
