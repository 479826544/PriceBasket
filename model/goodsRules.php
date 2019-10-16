<?php

namespace model;
class GoodsRules
{
    private static $instance = null;

    private static $array = null;

    private static $msg = null;

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

    public function discount($list)
    {
        self::$array = $list;
        $rules = include('config/goodsRules.php');
        foreach ($rules as $k => $v) {
            if ($v == true) {
                $this->$k();
            }
        }
        empty(self::$msg) && self::$msg[] = '(no offers available)';
        return array('list' => self::$array, 'msg' => self::$msg);
    }

    /**
     * 苹果规则
     */
    public function rule_one()
    {
        foreach (self::$array as $k => $v) {
            if ($v['goods_name'] == 'Apples') {
                self::$array[$k]['discount_nums'] = $v['nums'];
                self::$array[$k]['nums'] = 0;
                self::$array[$k]['discount_price'] = $v['normal_price'] * 0.9;
                $save_money = round(self::$array[$k]['discount_nums'] * $v['normal_price'] * 0.1, 2);
                self::$msg[] = "Apples 10% off: " . $save_money . 'p';
            }
        }
    }

    /**
     *汤和面包规则
     */
    public function rule_two()
    {
        $soup_array = array_merge($this->filter_by_value(self::$array, 'goods_name', 'Soup'));
        $bread_array = array_merge($this->filter_by_value(self::$array, 'goods_name', 'Bread'));
        //可打折数量
        $soup_discount_nums = floor($soup_array[0]['nums'] / 2);

        if (!empty($soup_array) && $soup_array[0]['nums'] > 1 && !empty($bread_array)) {
            foreach (self::$array as $k => $v) {
                if ($v['goods_name'] == 'Bread') {
                    if ($soup_discount_nums > $v['nums']) {
                        self::$array[$k]['discount_nums'] = $v['nums'];
                        self::$array[$k]['nums'] = 0;
                        self::$array[$k]['discount_price'] = $v['normal_price'] * 0.5;
                    } else {
                        self::$array[$k]['discount_nums'] = $soup_discount_nums;
                        self::$array[$k]['nums'] = $v['nums'] - $soup_discount_nums;
                        self::$array[$k]['discount_price'] = $v['normal_price'] * 0.5;
                    }
                    $save_money = self::$array[$k]['discount_nums'] * $v['normal_price'] * 0.5;
                    self::$msg[] = self::$array[$k]['discount_nums'] . ' Bread 50% ,off: ' . $save_money . 'p';
                }
            }
        }
    }

    /**
     * 帮助函数
     */
    public function filter_by_value($array, $index, $value)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];

                if ($temp[$key] == $value) {
                    $newarray[$key] = $array[$key];
                }
            }
        }
        return $newarray;
    }


}