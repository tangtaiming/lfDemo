<?php
/**
 * User: tangtaiming
 * Date: 2020/4/5
 * Time: 15:17
 */

namespace app\api\controller;


use app\api\http\response\ServiceResponse;
use app\api\model\Godformula;
use think\Controller;

/**
 * 式神Controller
 * Class GodformulaController
 * @package app\api\controller
 */
class GodformulaController extends Controller
{

    use ServiceResponse;
    private $godformulaDao;

    public function godformulas() {
        $godformulaDao = new Godformula();
        $godformulas = $godformulaDao->godformulaAllList();
        return $this->jsonSuccessData($godformulas);
    }

}