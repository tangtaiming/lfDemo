<?php
/**
 * User: tangtaiming
 * Date: 2020/4/4
 * Time: 17:45
 */

namespace app\api\model;

use think\Model;

/**
 * 用户实体
 * Class User
 * @package app\api\model
 */
class User extends Model
{

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

}