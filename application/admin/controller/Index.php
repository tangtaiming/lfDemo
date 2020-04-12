<?php
/**
 * User: tangtaiming
 * Date: 2020/4/11
 * Time: 13:10
 */

namespace app\admin\controller;


use think\Controller;

class Index extends Controller
{

    public function index() {
        return $this->fetch("index");
    }

}