<?php

namespace model;

use model\GoodsRules;

include('model/goodsRules.php');

class PriceBasket
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 结算
     */
    public function settle_accounts($list)
    {
        $GoodsRules = GoodsRules::getInstance();

        $goods_price = include('config/goodsPriceArray.php');
        //插入价格
        foreach ($list as $k => $v) {
            $list[$k]['normal_price'] = $list[$k]['discount_price'] = $goods_price[$v['goods_name']];
            $list[$k]['discount_nums'] = 0;
        }
        $res = $GoodsRules->discount($list);
        //整合价格
        foreach ($res['list'] as $k => $v) {
            $res['list'][$k]['total_normal_price'] = ($v['nums'] + $v['discount_nums']) * $v['normal_price'];
            $res['list'][$k]['total_discount_price'] = $v['discount_nums'] * $v['discount_price'] + $v['nums'] * $v['normal_price'];
        }
        $res['total_normal_price'] = round(array_sum(array_column($res['list'], 'total_normal_price')) / 100, 2);
        $res['total_discount_price'] = round(array_sum(array_column($res['list'], 'total_discount_price')) / 100, 2);
        return $res;
    }


}