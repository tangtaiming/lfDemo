<?php


namespace app\api\service;

use app\api\http\response\ServiceResponse;
use app\api\model\Learncard;
use app\common\ResponseData;
use think\Request;

/**
 * 学习卡片 业务处理
 * Class LearnCardService
 * @package app\api\service
 */
class LearnCardService
{

    use ServiceResponse;
    private $learnCardModel;

    public function __construct()
    {
        $this->learnCardModel = new Learncard();
    }

    /**
     * 学习卡片 集合信息
     * @param Request $re
     * @return mixed
     */
    public function index(Request $re) {
        $pageNumber = $re->param('pageNumber');
        $pageSize = $re->param('pageSize');
        if (is_null($pageNumber) || !is_numeric($pageNumber)) {
            $pageNumber = 1;
        }
        if (is_null($pageSize) || !is_numeric($pageSize)) {
            $pageSize = 20;
        }
        $learnCardList = $this->learnCardModel->page($pageNumber, $pageSize)->select();
        foreach ($learnCardList as $row) {
            $row->content = htmlentities($row->content);
        }
        return $this->jsonSuccessData($learnCardList);
    }

    /**
     * 保存学习卡片
     * @param Request $request
     */
    public function save(Request $request)
    {
        $title = $request->param('title');
        $conent = $request->param('content');
        $currentLearnDateTime = $this->createDate();
        $learnNumber = 1;
        $totalLearnNumber = 8;
        $learType = 1;
        $creator = 1;
        $cardGroup = 1;
        $data = [
            'title' => $title,
            'content' => $conent,
            'current_learn_datetime' => $currentLearnDateTime,
            'learn_number' => $learnNumber,
            'total_learn_number' => $totalLearnNumber,
            'learn_type' => $learType,
            'creator' => $creator,
            'create_date' => $currentLearnDateTime,
            'cardgroup_id' => $cardGroup
        ];
        $dataId = $this->learnCardModel->insertGetId($data);
        if ($dataId) {
            $data['id'] = $dataId;
            return $this->jsonSuccessData($data);
        }
        return $this->jsonData(ResponseData::ERROR_SAVE_FAIL[0], ResponseData::ERROR_SAVE_FAIL[1]);
    }

    /**
     * 创建时间
     */
    private function createDate() {
        $d = date('Y-m-d H:i:s', time());
        return $d;
    }



}