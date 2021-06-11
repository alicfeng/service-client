<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 */

namespace Samego\Client;

class Response
{
    /**
     * @var int 成功业务编码
     */
    private $success_code;

    public const SUCCESS_MESSAGE = 'Success'; // Success message
    public const FAILURE_MESSAGE = 'Failure'; // failure message

    public function __construct(array $config)
    {
        $this->success_code = $config['success_code'];
    }

    /**
     * @var int response code
     */
    private $code;

    /**
     * @var string response message
     */
    private $message = '';

    /**
     * @var array response data
     */
    private $data = [];

    /**
     * @var string 请求链路标识
     */
    private $request_id;

    /**
     * @function    setCode
     * @description 设置结构体响应码
     * @param int $code
     * @datetime    2021/5/18 下午3:44
     * @author      AlicFeng
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @function    getCode
     * @description 获取结构体响应码
     * @return int
     * @datetime    2021/5/18 下午3:48
     * @author      AlicFeng
     */
    public function getCode(): int
    {
        return (int) $this->code;
    }

    /**
     * @function    setMessage
     * @description 设置结构体信息节点
     * @param string $message
     * @datetime    2021/5/18 下午3:47
     * @author      AlicFeng
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @function    getMessage
     * @description 获取结构体信息节点
     * @return string
     * @datetime    2021/5/18 下午3:47
     * @author      AlicFeng
     */
    public function getMessage(): string
    {
        return (string) $this->message;
    }

    /**
     * @function    setData
     * @description 设置结构体数据节点
     * @param array $data
     * @datetime    2021/5/18 下午3:47
     * @author      AlicFeng
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @function    getData
     * @description 获取结构体数据节点
     * @return array
     * @datetime    2021/5/18 下午3:47
     * @author      AlicFeng
     */
    public function getData(): array
    {
        return (array) $this->data;
    }

    /**
     * @function    getRequestId
     * @description 获取请求标识
     * @return string
     * @datetime    2021/6/11 下午12:48
     * @author      AlicFeng
     */
    public function getRequestId(): string
    {
        return $this->request_id;
    }

    /**
     * @function    setRequestId
     * @description 设置请求标识
     * @param string $request_id 请求标识
     * @datetime    2021/6/11 下午12:48
     * @author      AlicFeng
     */
    public function setRequestId(string $request_id): void
    {
        $this->request_id = $request_id;
    }

    /**
     * @function    isSucceed
     * @description 判断业务是否请求处理成功
     * @return bool
     * @datetime    2021/5/18 下午3:47
     * @author      AlicFeng
     */
    public function isSucceed(): bool
    {
        return $this->success_code === $this->code;
    }

    /**
     * @function    transform
     * @description 报文转换
     * @param array $origin
     * @return self
     * @datetime    2021/5/18 下午3:46
     * @author      AlicFeng
     */
    public function transform(array $origin = []): self
    {
        $this->setCode($origin['code']);
        $this->setRequestId($GLOBALS['request_id']);

        // 失败时
        if ($this->success_code != $origin['code']) {
            $this->setMessage($origin['message'] ?? self::FAILURE_MESSAGE);

            return $this;
        }

        // 成功时
        $this->setMessage($origin['message'] ?? self::SUCCESS_MESSAGE);
        $this->setData($origin['data']);

        return $this;
    }
}
