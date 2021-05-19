<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 */

namespace Samego\Client\Exceptions;

use Exception;
use Throwable;

abstract class ExceptionAbstract extends Exception
{
    private $code_enum;

    public function __construct(array $code_enum, string $message = '', Throwable $previous = null, ?int $code = 0)
    {
        $this->code_enum = $code_enum;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @function    获取codeEnum
     * @description 供rspHelper使用
     * @return array
     * @author      AlicFeng
     * @datatime    19-12-23 下午5:32
     */
    public function getCodeEnum(): array
    {
        return $this->code_enum;
    }
}
