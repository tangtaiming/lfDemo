<?php
/**
 * User: tangtaiming
 * Date: 2020/4/10
 * Time: 23:48
 */

namespace app\api\exceptions;

/**
 * 系统异常
 * Class TpException
 * @package app\api\exceptions
 */
class TpException extends \RuntimeException
{

    public function __construct(array $apiResponseData, Throwable $previous = null)
    {
        $code = $apiResponseData[0];
        $message = $apiResponseData[1];
        parent::__construct($message, $code, $previous);
    }

}