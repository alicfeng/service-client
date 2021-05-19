<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 */

namespace Samego\Client;

class CodeEnum
{
    const HTTP_SERVER_CONNECT_EXCEPTION  = [9001, '服务连接异常'];
    const HTTP_SERVER_REQUEST_EXCEPTION  = [9002, '服务请求异常'];
    const HTTP_SERVER_ENDPOINT_EXCEPTION = [9003, '服务端点异常'];
    const HTTP_CLIENT_GUZZLE_EXCEPTION   = [9003, '请求端点异常'];
}
