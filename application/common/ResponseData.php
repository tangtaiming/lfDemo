<?php
/**
 * User: tangtaiming
 * Date: 2020/4/4
 * Time: 10:37
 */

namespace app\common;

/**
 * 错误返回类
 * Class ResponseData
 * @package app\common
 */
class ResponseData
{

    /**
     * API 通用错误码
     *
     * error_code < 1000
     */
    const SUCCESS = [200, 'Success'];

    const TOKEN_NOT_ERROR = [401, 'Token 缺失'];

    const TOKEN_EXPIRED_ERROR = [402, 'Token 过期'];

    const UNKNOWN_ERROR = [500, '未知错误'];

    const ERROR_URL = [501, '访问接口不存在'];

    /**
     * error_code 10001-11000 用户登录错误码
     */
    const ERROR_PASSWORD = [10001, '密码错误'];

}