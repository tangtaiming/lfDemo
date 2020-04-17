<?php


namespace app\api\controller\v1;

use app\api\service\OvertimeService;
use think\Controller;

/**
 * 加班管理 接口
 * Class OvertimeController
 * @package app\api\controller\v1
 */
class OvertimeController extends Controller
{

    private $overTimeService;

    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->overTimeService = new OvertimeService();
    }

    /**
     * 显示资源列表
     * @return mixed
     */
    public function index() {
        return $this->overTimeService->fetchOverTimeList();
    }

}