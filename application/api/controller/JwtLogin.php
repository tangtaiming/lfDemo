<?php
/**
 * User: tangtaiming
 * Date: 2020/4/3
 * Time: 0:59
 */

namespace app\api\controller;

use app\api\auto\JwtAuto;
use app\api\http\response\ServiceResponse;
use think\Controller;

load_trait('app/api/http/response/ServiceResponse');

/**
 * jwt 登录授权
 * Class JwtLogin
 * @package app\api\controller
 */
class JwtLogin extends Controller
{

    use ServiceResponse;

    /**
     * 登录授权
     * @return mixed
     */
    public function auth() {
        //获取客户端传递的参数
        $username = '123';
        $password = '321';

        //去数据库校验用户信息的uid

        //获取JWT的句柄
        $jwtAuth = JwtAuto::getInstance();
        $token = $jwtAuth->setUid(1)->encode()->getToken();
        return $this->jsonSuccessData([
            'token' => $token
        ]);
    }


}