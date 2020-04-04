<?php
/**
 * User: tangtaiming
 * Date: 2020/4/4
 * Time: 16:34
 */

namespace app\api\exceptions;

use Throwable;

/**
 * Api 错误异常
 * Class ApiException
 * @package app\api\exceptions
 */
class ApiException extends \RuntimeException
{

    public function __construct(array $apiResponseData, Throwable $previous = null)
    {
        $code = $apiResponseData[0];
        $message = $apiResponseData[1];
        parent::__construct($message, $code, $previous);
    }

}