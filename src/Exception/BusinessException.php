<?php


namespace Hewo\Lib\Exception;


use Hyperf\HttpMessage\Exception\HttpException;

class BusinessException extends HttpException
{
    public function __construct($message = '业务处理错误', $status = 200, $code = 500, \Throwable $previous = null)
    {
        parent::__construct($status, $message, $code, $previous);
    }
}