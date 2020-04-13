<?php


namespace app\index\service;


use app\api\http\response\ServiceResponse;
use think\Request;

class OvertimeService
{

    use ServiceResponse;

    public function save(Request $request) {
        $userId = $request->param('overtimeUserId');
        $overtime = $request->param('overDateTime');
        $overTimeOrm = [
            'user_id' => $userId,
            'over_date_time' => $overtime
        ];
        //id 用户id 用户名称 加班时间 创建时间
        $jsonData = $this->jsonSuccessData($overTimeOrm);
        echo $jsonData;
    }

}