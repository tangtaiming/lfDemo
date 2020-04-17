<?php


namespace app\api\model;


use think\Db;
use think\Model;

class OverDatetime extends Model
{

    private $db;

    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->db = Db::name('over_datetime');
    }

    public function fetchOverDateTimList($page = 1, $pageSize = 20) {
        return $this->db->page($page, $pageSize)->select();
    }

}