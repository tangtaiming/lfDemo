<?php


namespace app\api\service;


use app\api\http\response\ServiceResponse;
use app\api\model\OverDatetime;

class OvertimeService
{

    use ServiceResponse;

    private $overDateTimeDao;

    // 初始化
    protected function initialize()
    {
        $this->overDateTimeDao = new OverDatetime();
    }

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * 获取加班集合数据
     * @param $page
     * @param $pageSize
     * @return false|string
     */
    public function fetchOverTimeList($page = 1, $pageSize = 20) {
        $this->overDateTimeDao = new OverDatetime();
        $overTimeList = $this->overDateTimeDao->fetchOverDateTimList($page, $pageSize);
        return $this->jsonSuccessData($overTimeList);
    }




}