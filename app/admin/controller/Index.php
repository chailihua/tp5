<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\paginator\driver\Bootstrap;
use think\Request;
use page\Page;

class Index extends Controller
{
    public function index()
    {
        $p  = Db::name('house_reserve')->paginate(10,false, ['query' => Request::instance()->param()]);
        $list = Db::table('web_house_reserve')
            ->paginate(10);
        $house_type = Db::table('web_house_type')->select();
        $page = $p->render();
        $type_conf = [];
        foreach ($house_type as $val){
            $type_conf[$val['id']] = $val['des'];
        }
        $this->assign([
            'list'  => $list,
            'type_conf' => $type_conf,
            'page' => $p->render(),
        ]);
        // 模板输出
        return $this->fetch();
    }
}
