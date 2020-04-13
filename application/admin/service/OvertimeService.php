<?php
/**
 * User: tangtaiming
 * Date: 2020/4/10
 * Time: 23:19
 */

namespace app\admin\service;


use app\admin\model\OverDatetime;
use app\api\exceptions\TpException;
use app\api\http\response\JuiServiceResponse;
use app\common\ResponseData;
use think\Paginator;
use think\Request;

class OvertimeService
{

    use JuiServiceResponse;
    private $overTimeDao;

    private $navTabId = 'overtime-manager';

    // 初始化
    protected function initialize()
    {
        $this->overTimeDao = new OverDatetime();
    }

    public function __construct()
    {
        // Service 初始化
        $this->initialize();
    }

    public function index(Request $request) {
        $pageNum = $request->param('pageNum');
        $numPerPage = $request->param('numPerPage');
        $orderField = $request->param('orderField');
        $orderDirection = $request->param('orderDirection');
        if (is_null($orderField) || empty($orderField)) {
            $orderField = 'id';
        }
        if (is_null($orderDirection) || empty($orderDirection)) {
            $orderDirection = 'desc';
        }
        if (empty($pageNum) || !is_numeric($pageNum)) {
            $pageNum = 1;
        }
        if (empty($numPerPage) || !is_numeric($numPerPage)) {
            $numPerPage = 20;
        }

        $query = [];
        foreach ($request->param() as $key=>$vo) {
            if ($key == 'pageNum' || $key == 'numPerPage' || $key == 'orderField' || $key == 'orderDirection' || $key == '_') {
                continue;
            }
//            echo json_encode($key);
            $query[$key] = $vo;
        }
//        echo json_encode($query);
        $overDatetimeCount =
//            0;
            $this->overTimeDao->fetchOverDatetimeCollectionCount();
        $overDatetimeList = $this->overTimeDao->fetchOverDatetimeCollection($query, $pageNum, $numPerPage, $orderField, $orderDirection);
        $pager = TpPager::make($overDatetimeList, $numPerPage, $pageNum, $overDatetimeCount);
//        echo json_encode($pager);
        $data = [
//            'overDateTimeList' => $overDatetimeList,
            'orderField' => $orderField,
            'orderDirection' => $orderDirection,
//            'pageNum' => $pageNum,
//            'numPerPage' => $numPerPage,
            'page' => $pager->toArray(),
            'query' => $query
        ];
//        echo json_encode($data);
        return $data;
    }

    public function save(Request $request) {
        $userId = $request->param('overtimeUserId');
        //截止时间
        $cutoffTime = $request->param('cutoffTime');
        //创建时间
        $createDateTime = $request->param('createDateTime');
        if (is_null($userId)) {
            throw new TpException(ResponseData::ERROR_USER_ID_NULL);
        }
        if (is_null($cutoffTime)) {
            throw new TpException(ResponseData::ERROR_OVER_TIME_NULL);
        }
        if (is_null($createDateTime)) {
            throw new TpException(ResponseData::ERROR_CREATE_TIME_NULL);
        }

        //截止时间 是等于加班开始时间那天日期
        $startDate = $currentDate = date("Y-m-d", strtotime($createDateTime));
        $startDateTime = $startDate.' '.$cutoffTime;
        //计算时间差
        $timeDifference = (strtotime($createDateTime) - strtotime($startDateTime)) / 60 / 60;
//        $timeDifferenceRound = round($timeDifference, 4);
        $overTimeModel = [
            'user_id' => $userId,
            'over_datetime' => $timeDifference,
            'create_datetime' => $createDateTime
        ];
        $overTimeDao = new OverDatetime();
        $insertId = $overTimeDao->saveOverDateTime($overTimeModel);
        if ($insertId > 0) {
          return $this->successRefreshNavTabIdAndCloseCurrent($this->navTabId);
        }
        return $this->fail(ResponseData::ERROR_SAVE_FAIL[0], ResponseData::ERROR_SAVE_FAIL[1]);
    }

    /**
     * 批量删除
     * @param Request $request
     * @return mixed
     */
    public function batchDelete(Request $request) {
        $ids = $request->post('ids');
        $arr = explode(',', $ids);
        foreach ($arr as $idRow) {
            $this->overTimeDao->deleteOverDateTime($idRow);
        }
        return $this->successRefreshNavTabId($this->navTabId);
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request) {
        $id = $request->param('id');
        $this->overTimeDao->deleteOverDateTime($id);
        return $this->successRefreshNavTabId($this->navTabId);
    }


    public function overDateTimeEditData($id) {
        $overDateTime = $this->overTimeDao->editOverDateTime($id);
        $currentDateTime = $overDateTime['create_datetime'];
        $overDateTime = $overDateTime['over_datetime'];
        $currentDateTimeTime = strtotime($currentDateTime);
        //秒 为单位
        $overDateTimeTime = $overDateTime * 60 * 60;

        $cutoff = $currentDateTimeTime - $overDateTimeTime;
        $cutoffTime = date('H:i:s', $cutoff);
        $data = [
            'currentDateTime' => $currentDateTime,
            'overStartDatetime' => $cutoffTime
        ];
        return $data;
//        echo json_encode($data);
    }

    /**
     * 当前时间
     */
    private function currentDateTime() {
        return date("Y-m-d H:i:s", time());
    }

    /**
     * 加班时间
     */
    private function overStartDatetime() {
        $currentDate = '18:30:00';
        return $currentDate;
    }

    public function overDateTimeCreateData() {
        $currentDateTime = $this->currentDateTime();
        $overStartDatetime = $this->overStartDatetime();
        $data = [
          'currentDateTime' => $currentDateTime,
          'overStartDatetime' => $overStartDatetime
        ];
        return $data;
    }

}