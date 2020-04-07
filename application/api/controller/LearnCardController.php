<?php


namespace app\api\controller;


use app\api\http\response\ServiceResponse;
use app\api\service\LearnCardService;
use think\App;
use think\Controller;
use think\Request;

/**
 * 学习卡片
 * Class LearnCardController
 * @package app\api\controller
 */
class LearnCardController extends Controller
{

    use ServiceResponse;
    private $learCardService;

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->learCardService = new LearnCardService();
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return $this->learCardService->index($this->request);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        echo 'create';
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        return $this->learCardService->save($request);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        echo 'r 1';
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        echo 'edit';
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        echo 'update';
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        echo 'delete';
    }

}