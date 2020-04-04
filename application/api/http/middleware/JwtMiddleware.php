<?php
/**
 * User: tangtaiming
 * Date: 2020/4/3
 * Time: 1:33
 */
namespace app\api\http\middleware;

use app\api\auto\JwtAuto;
use app\api\exceptions\ApiException;
use app\api\http\response\ServiceResponse;
use app\common\ResponseData;
use think\Exception;
use think\Response;

/**
 * JWT中间件使用
 * Class JwtMiddleware
 * @package app\api\middleware
 */
class JwtMiddleware
{

    use ServiceResponse;

    public function handle($request, \Closure $next)
    {
        $token = $request->param('token');
        if ($token) {
            $jwtAuth = JwtAuto::getInstance();
            $jwtAuth->setToken($token);
            $validate = $jwtAuth->validate();
            $verify = $jwtAuth->verify();

            if ($validate && $verify) {
                return $next($request);
            } else {
                throw new ApiException(ResponseData::TOKEN_EXPIRED_ERROR);
            }
        } else {
            throw new ApiException(ResponseData::TOKEN_NOT_ERROR);
        }
    }

}