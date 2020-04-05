<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/3/31
 * Time: 20:43
 */

namespace app\api\controller;

use app\api\http\response\ServiceResponse;
use app\api\model\DoubanMovie;
use app\api\model\User;
use think\Controller;

class Movie extends Controller
{
    use ServiceResponse;

    public function movieList() {
        $movieDao = new \app\api\model\DoubanMovie();
        $movieList = $movieDao->findMovieList();
        return $this->jsonSuccessData($movieList);
    }

}