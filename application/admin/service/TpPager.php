<?php
/**
 * User: tangtaiming
 * Date: 2020/4/12
 * Time: 9:33
 */

namespace app\admin\service;


use think\Paginator;

/**
 * TP 5分页
 * Class TpPager
 * @package app\admin\service
 */
class TpPager extends Paginator
{

    /**
     * 页面下拉选项
     * @var
     */
    private $numPerPageOption = [20, 50, 100, 200];

    /**
     * 渲染分页html
     * @access public
     * @return mixed
     */
    public function render()
    {
        // TODO: Implement render() method.
    }

    /**
     * @param mixed $numPerPageOption
     */
    public function setNumPerPageOption($numPerPageOption)
    {
        $this->numPerPageOption = $numPerPageOption;
    }

    public function toArray()
    {
        try {
            $total = $this->total();
        } catch (\DomainException $e) {
            $total = null;
        }

        return [
            'total'        => $total,
            'per_page'     => $this->listRows(),
            'current_page' => $this->currentPage(),
            'last_page'    => $this->lastPage,
            'per_page_option' => $this->numPerPageOption,
            'data'         => $this->items->toArray(),
        ];
    }

}