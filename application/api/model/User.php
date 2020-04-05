<?php
/**
 * User: tangtaiming
 * Date: 2020/4/4
 * Time: 17:45
 */

namespace app\api\model;

use think\console\Table;
use think\Db;
use think\Model;

/**
 * 用户实体
 * Class User
 * @package app\api\model
 */
class User extends Model
{

    private static $table;

    protected static function init()
    {
        self::$table = Db::table('douban_movie');
    }

    /**
     * 查询所有数据
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function findAll() {
        return self::$table->select();
    }

}