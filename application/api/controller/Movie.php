<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/31
 * Time: 20:43
 */

namespace app\api\controller;

use app\api\http\response\ServiceResponse;
use think\Controller;

load_trait('app/api/http/response/ServiceResponse');

class Movie extends Controller
{
    use ServiceResponse;

    public function movieList() {
        return $this->jsonSuccessData(['hello' => '123']);
    }

}