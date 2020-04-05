<?php
/**
 * User: tangtaiming
 * Date: 2020/4/5
 * Time: 15:10
 */

namespace app\api\model;

use think\Db;
use think\Model;

/**
 * 式神
 * Class Godformula
 * @package app\api\model
 */
class Godformula extends Model
{

    private $db = '';

    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->db = Db::name('godformula');
    }

    /**
     * 查询式神所有数据
     * @return mixed
     */
    public function godformulaAllList() {
        return $this->db->select();
    }

}