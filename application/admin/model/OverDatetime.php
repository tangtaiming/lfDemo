<?php
/**
 * User: tangtaiming
 * Date: 2020/4/11
 * Time: 0:04
 */

namespace app\admin\model;


use think\Db;
use think\db\Query;
use think\Model;

/**
 * 加班模型
 * Class OverDatetime
 * @package app\admin\model
 */
class OverDatetime extends Model
{

    private $db;

    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->db = Db::name('over_datetime');
    }

    public function saveOverDateTime($model) {
        return $this->db->insert($model);
    }

    public function fetchOverDatetimeList($page = 1, $pageSize = 20) {
        $overDateTimeList = $this->db->page($page, $pageSize)->select();
        return $overDateTimeList;
    }

    /**
     * @param array $query
     * @param int $page
     * @param int $pageSize
     * @param string $orderField
     * @param string $orderDirection
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function fetchOverDatetimeCollection($query = [], $page = 1, $pageSize = 20, $orderField = 'id', $orderDirection = 'desc')
    {
        $sort = $orderField.' '.$orderDirection;
        foreach ($query as $key=>$vo)
        {
            if (is_array($vo)) {
//                if (strpos($key, 'time') || strpos($key, 'date')) {
//                    $this->db
//                        ->where($key, '>', $vo['to'])
//                        ->where($key, '<=', $vo['form']);
//                    continue;
//                }
                if (!(empty($vo['to']) || empty($vo['form']))) {
                    $between = $vo['to'].','.$vo['form'];
                    $this->db->whereBetween($key, $between);
                }
            } else {
                $this->db->where($key, $vo);
            }
        }
        $overDateTimeList = $this->db->order($sort)->page($page, $pageSize)->select();
//        $sql = $this->db->getLastSql();
//        echo json_encode($sql);
        return $overDateTimeList;
    }

    public function fetchOverDatetimeCollectionCount($query = [])
    {
        return $overDateTimeList = $this->db->count();
    }

    public function deleteOverDateTime($id) {
        return $this->db->delete($id);
    }

    public function editOverDateTime($id) {
        return $this->db->get($id);
    }

}