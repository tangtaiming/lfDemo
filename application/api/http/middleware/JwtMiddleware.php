<?php
/**
 * User: tangtaiming
 * Date: 2020/4/3
 * Time: 1:33
 */
namespace app\api\http\middleware;

use app\api\auto\JwtAuto;
use app\api\http\response\ServiceResponse;

load_trait('app/api/http/response/ServiceResponse');

/**
 * JWT中间件使用
 * Class JwtMiddleware
 * @package app\api\middleware
 */
class JwtMiddleware
{

    public function __construct()
    {
    }

    use ServiceResponse;

    public function handle($request, \Closure $next)
    {
        $token = $request->input('token');
        if ($token)
        {
            $jwtAuth = JwtAuto::getInstance();
            $jwtAuth->setToken($token);

            if ($jwtAuth->validate() && $jwtAuth->verify()) {
                return $next($request);
            } else {
                return $this->jsonData(400, '登录过期');
            }
        } else {
            return $this->jsonData('400','参数错误');
        }
    }

}