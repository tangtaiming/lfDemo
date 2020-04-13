<?php
/**
 * User: tangtaiming
 * Date: 2020/4/11
 * Time: 19:58
 */
namespace app\api\http\response;

use app\common\ResponseData;

/**
 * J-UI框架 前段返回固定格式
 * Class AdminServiceResponse
 * @package app\api\http\response
 */
trait JuiServiceResponse
{

    /**
     * 失败
     * @param $code
     * @param $msg
     * @return mixed
     */
    public function fail($code, $msg) {
        return $this->jsonResponse(
            $code,
            $msg,
            '',
            '',
            'closeCurrent',
            ''
        );
    }

    /**
     * 成功并且刷新对应页面关闭当前页面
     * @param $navTabId
     * @return mixed
     */
    public function successRefreshNavTabIdAndCloseCurrent($navTabId) {
        return $this->jsonResponse(
            ResponseData::SUCCESS[0],
            ResponseData::SUCCESS[1],
            $navTabId,
            '',
            'closeCurrent',
            ''
        );
    }

    /**
     * 成功并且刷新对应页面
     * @param $navTabId
     * @return mixed
     */
    public function successRefreshNavTabId($navTabId) {
        return $this->jsonResponse(
            ResponseData::SUCCESS[0],
            ResponseData::SUCCESS[1],
            $navTabId,
            '',
            '',
            ''
        );
    }

    /**
     * 成功并且关闭页面
     * @return mixed
     */
    public function successCloseCurrent() {
        return $this->jsonResponse(
            ResponseData::SUCCESS[0],
            ResponseData::SUCCESS[1],
            '',
            '',
            'closeCurrent',
            ''
        );
    }

    /**
     * 成功
     * @return mixed
     */
    public function success() {
        return $this->jsonResponse(
          ResponseData::SUCCESS[0],
          ResponseData::SUCCESS[1],
          '',
          '',
          '',
          ''
        );
    }

    /**
     * 返回参数
     * @param $code
     * @param $msg
     * @param $navTabId
     * @param $rel
     * @param $callbackType
     * @param $forwardUrl
     * @return mixed
     */
    public function jsonResponse($code, $msg, $navTabId, $rel, $callbackType, $forwardUrl) {
        $jsonData = [
            'statusCode' => $code,
            'message' => $msg,
            'navTabId' => $navTabId,
            'rel' => $rel,
            'callbackType' => $callbackType,
            'forwardUrl' => $forwardUrl
        ];

        return $jsonData;
    }

}