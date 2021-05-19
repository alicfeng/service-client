<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 */

namespace Samego\Client\Supports\Http;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Samego\Client\CodeEnum;
use Samego\Client\Contracts\HttpRequestInterface;
use Samego\Client\Exceptions\ServerHttpException;
use Samego\Client\Response;

class Request implements HttpRequestInterface
{
    /**
     * @var array 配置信息
     */
    private $config;

    /**
     * @var array 约定配置
     */
    private $arrangement;

    /**
     * @var Client 客户端实例
     */
    private $_client;

    /**
     * @var string 请求方法
     */
    private $method;

    /**
     * @var array 默认配置项
     */
    private $default;

    /**
     * @var string 请求路径
     */
    private $uri;

    /**
     * @var array 请求头部
     */
    private $headers = [];

    /**
     * @var array 请求报文体
     */
    private $package = [];

    public function __construct(array $config, array $arrangement)
    {
        $this->config      = $config;
        $this->arrangement = $arrangement;
        $this->_client     = new Client();
    }

    /**
     * @function    service
     * @description 指定服务路由
     * @param string $name 服务路由名称
     * @return $this
     * @datetime    2021/5/19 上午1:07
     * @author      AlicFeng
     */
    public function service(string $name): self
    {
        $this->uri     = $this->config['routes'][$name]['uri'];
        $this->method  = $this->config['routes'][$name]['method'];
        $this->headers = $this->config['routes'][$name]['headers'] ?? [];

        $this->default = $this->config['groups'][explode('.', $name)[0]];

        return $this;
    }

    /**
     * @function    package
     * @description 设定报文
     * @param array $package
     * @return $this
     * @datetime    2021/5/19 上午1:08
     * @author      AlicFeng
     */
    public function package(array $package = []): self
    {
        $this->package = $package;

        return $this;
    }

    /**
     * @function    uri
     * @description 指定请求路由
     * @param string $uri 请求路由
     * @return $this
     * @datetime    2021/5/19 上午1:09
     * @author      AlicFeng
     */
    public function uri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @function    header
     * @description 追加指定头部
     * @param array $headers
     * @return Request
     * @datetime    2021/5/19 上午2:54
     * @author      AlicFeng
     */
    public function header(array $headers = []): self
    {
        foreach ($headers as $key => $value) {
            $this->default['headers'][$key] = $value;
        }

        return $this;
    }

    /**
     * @function    request
     * @description 触发句柄请求
     * @return Response
     * @throws ServerHttpException
     * @author      AlicFeng
     * @datatime    2021/5/18 下午2:45
     */
    public function request(): Response
    {
        try {
            $this->default['json'] = $this->package;
            $response              = $this->_client->request($this->method, $this->uri, $this->default);
            $result                = $response->getBody()->getContents();

            Log::info('training convert request package', [$this->method, $this->uri, $this->package, $result]);

            return (new Response($this->arrangement))->transform(json_decode($result, true));
        } catch (ConnectException $exception) {
            throw new ServerHttpException(CodeEnum::HTTP_SERVER_CONNECT_EXCEPTION, $exception->getMessage());
        } catch (RequestException $exception) {
            throw new ServerHttpException(CodeEnum::HTTP_SERVER_REQUEST_EXCEPTION, $exception->getMessage());
        } catch (Exception $exception) {
            throw new ServerHttpException(CodeEnum::HTTP_SERVER_ENDPOINT_EXCEPTION, $exception->getMessage());
        } catch (GuzzleException $exception) {
            throw new ServerHttpException(CodeEnum::HTTP_CLIENT_GUZZLE_EXCEPTION, $exception->getMessage());
        }
    }
}
