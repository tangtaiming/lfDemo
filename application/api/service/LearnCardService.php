<?php


namespace app\api\service;

use app\api\model\Learncard;
use think\Request;

/**
 * 学习卡片 业务处理
 * Class LearnCardService
 * @package app\api\service
 */
class LearnCardService
{

    private $learnCardModel;

    public function __construct()
    {
        $this->learnCardModel = new Learncard();
    }

    public function index(Request $re) {
        $pageNumber = $re->param('pageNumber');
        $pageSize = $re->param('pageSize');
        if (is_null($pageNumber) || !is_numeric($pageNumber)) {
            $pageNumber = 1;
        }
        if (is_null($pageSize) || !is_numeric($pageSize)) {
            $pageSize = 20;
        }

        $learnCard = $this->learnCardModel->whereColumn('id')->page($pageNumber, $pageSize)->select();
        return $learnCard->id;
    }

}