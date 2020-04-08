<?php


namespace app\index\controller;

use app\index\service\OvertimeService;
use think\Controller;
use think\Request;

/**
 * 加班打卡
 * Class OvertimeController
 * @package app\index\controller
 */
class OvertimeController extends Controller
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index() {
        return 'index';
    }

    /**
     * 显示创建打卡加班表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch('index');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $overtimeService = new OvertimeService();
        $overtimeService->save($request);
    }

}