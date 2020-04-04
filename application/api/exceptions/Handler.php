<?php
/**
 * User: tangtaiming
 * Date: 2020/4/4
 * Time: 16:38
 */

namespace app\api\exceptions;


use app\api\http\response\ServiceResponse;
use app\common\ResponseData;
use Exception;
use think\exception\Handle;
use think\Response;

/**
 * 异常处理接管
 * Class Handler
 * @package app\api\exceptions
 */
class Handler extends Handle
{

    use ServiceResponse;

    public function render(Exception $e)
    {
        if ($e instanceof ApiException) {
            $code = $e->getCode();
            $message = $e->getMessage();
            return Response::create($this->jsonData($code, $message));
        } else {
            $code = $e->getCode();
            if (!$code || $code < 0) {
                $code = ResponseData::UNKNOWN_ERROR[0];
            }
            $message = $e->getMessage() ? $e->getMessage() : ResponseData::UNKNOWN_ERROR[1];

            return Response::create($this->jsonData($code, $message));
        }
//        return parent::render($e);
    }

}