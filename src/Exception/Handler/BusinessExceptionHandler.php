<?php


namespace Hewo\Lib\Exception\Handler;


use Hewo\Lib\Exception\BusinessException;
use Hewo\Lib\Response\BusinessResponse;
use Hyperf\ExceptionHandler\Annotation\ExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * Class BusinessExceptionHandler
 * @package Hewo\Lib\Exception\Handler
 * @ExceptionHandler
 */
class BusinessExceptionHandler extends \Hyperf\ExceptionHandler\ExceptionHandler
{
    public const HTTP_STATUS = 200;

    /**
     * Handle the exception, and return the specified result.
     *
     * @param Throwable|BusinessException $throwable
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        $businessResponse = make(BusinessResponse::class);
        return $businessResponse->fail($throwable->getMessage(), $throwable->getCode())
            ->withStatus($throwable->getStatusCode());
    }

    /**
     * Determine if the current exception handler should handle the exception,.
     *
     * @param Throwable $throwable
     * @return bool
     *              If return true, then this exception handler will handle the exception,
     *              If return false, then delegate to next handler
     */
    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof BusinessException;
    }
}