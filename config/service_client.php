<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 */

return [
    'arrangement' => [
        'success_code' => 1000,
    ],
    // 协议驱动 HTTP
    'http'        => [
        // 路由列表
        'routes' => [
            // 服务路由 服务名称.路由别名
            'user.profile' => [
                'uri'     => '/api/user',
                'method'  => 'GET',
                'headers' => [
                ],
            ],
        ],
        // 服务分组 配置每组服务通用配置
        'groups' => [
            'user' => [
                'timeout'  => 60,
                'base_uri' => env('SERVICE_CLIENT_USER_SERVER_BASE_URI'),
                'verify'   => env('SERVICE_CLIENT_USER_SERVER_VERIFY', false),
                'headers'  => [
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                    'Cache-Control' => 'no-cache',
                    'X-Ca-Stage'    => env('SERVICE_CLIENT_USER_SERVER_HEADER_STAGE', 'TEST'),
                    'Module-Id'     => env('SERVICE_CLIENT_USER_SERVER_HEADER_MODULE', 'USER'),
                ],
            ],
        ],
    ],
];
