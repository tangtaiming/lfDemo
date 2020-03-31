<?php
namespace app\api\http\response;
/**
 * User: tangtaiming
 * Date: 2020/3/31
 * Time: 21:46
 */
trait ServiceResponse
{

    /**
     * APP接口出现业务异常返回
     * @param $code
     * @param $msg
     * @param array $data
     * @return false|string
     */
    public function jsonData($code, $msg, $data = [])
    {
        return $this->jsonResponse($code, $msg, $data);
    }

    /**
     * APP 接口请求成功时返回
     * @param array $data
     * @return false|string
     */
    public function jsonSuccessData($data = [])
    {
        return $this->jsonResponse(200, 'success', $data);
    }

    /**
     * APP 接口请求返回值
     * @param $code
     * @param $msg
     * @param $data
     * @return false|string
     */
    private function jsonResponse($code, $msg, $data)
    {
        $content = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return json_encode($content);
    }

}