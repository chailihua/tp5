<?php
namespace app\home\controller;
use think\Controller;

class Reverse extends Controller
{
    public function index()
    {
        // 模板变量赋值
        $this->assign('dp','ThinkPHP');
        $this->assign('D','thinkphp@qq.com');
        // 或者批量赋值
        $this->assign([
            'name'  => 'ThinkPHP',
            'email' => 'thinkphp@qq.com'
        ]);
        // 模板输出
        return $this->fetch('index');
    }
}
