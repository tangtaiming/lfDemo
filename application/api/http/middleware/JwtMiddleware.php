<?php
/**
 * User: tangtaiming
 * Date: 2020/4/3
 * Time: 1:33
 */
namespace app\api\http\middleware;

use app\api\auto\JwtAuto;
use app\api\http\response\ServiceResponse;
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

            $validate = false;
            $verify = false;
            try {
                $validate = $jwtAuth->validate();
                $verify = $jwtAuth->verify();
            } catch (\InvalidArgumentException $e) {
                return new Response($this->jsonData(400, 'Token 非法'));
            } catch (\RuntimeException $re) {
                return new Response($this->jsonData(400, '系统内部解析错误, 结果:'));
            }

            if ($validate && $verify) {
                return $next($request);
            } else {
                return new Response($this->jsonData(400, '登录过期'));
            }
        } else {
            return new Response($this->jsonData(400, 'Token 缺失'));
        }
    }

}