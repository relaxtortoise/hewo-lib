<?php


namespace Hewo\Lib\Response;

use Hyperf\HttpServer\Response;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * 业务响应
 * @package Hewo\Lib\Response
 */
class BusinessResponse extends Response
{
    public const HTTP_STATUS_OK = 200;

    /**
     * 成功返回
     *
     * @param array $data
     * @param string $message
     * @param int $code
     * @return PsrResponseInterface
     */
    public function success($data = [], string $message = "操作成功", int $code = 200): PsrResponseInterface
    {
        return $this->json([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ])->withStatus(static::HTTP_STATUS_OK);
    }

    /**
     * 保存成功返回
     *
     * @param array $data
     * @param string $message
     * @return PsrResponseInterface
     */
    public function saveSuccess($data = [], $message = "保存") : PsrResponseInterface
    {
        return $this->success($data, $message, 201);
    }

    /**
     * 删除成功返回
     *
     * @param array $data
     * @param string $message
     * @return PsrResponseInterface
     */
    public function deleteSuccess($data = [], $message = "更新成功") : PsrResponseInterface
    {
        return $this->success($data, $message);
    }

    /**
     * 业务处理失败
     *
     * @param string $message
     * @param int $code
     * @return PsrResponseInterface
     */
    public function fail($message = "业务错误", $code = 500): PsrResponseInterface
    {
        return $this->json([
            "code" => $code,
            "message" => $message
        ])->withStatus(static::HTTP_STATUS_OK);
    }
}