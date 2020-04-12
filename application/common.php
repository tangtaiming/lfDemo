<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function getUserNameByUserId($userId)
{
    return '唐太明';
}

/**
 * 四舍五入 保留4位小数
 * @param $over_datetime
 * @return float
 */
function roundFour($over_datetime)
{
    return round($over_datetime, 1);
}