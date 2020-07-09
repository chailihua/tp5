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
        $status_conf = [
            '0' => '待入住',
            '1' => '未入住退房',
            '2' => '入住后退房',
        ];
        $this->assign([
            'list'  => $list,
            'type_conf' => $type_conf,
            'status_conf' => $status_conf,
            'page' => $p->render(),
        ]);
        // 模板输出
        return $this->fetch();
    }

    //修改房间状态
    public function editStatus()
    {
        if(request()->isAjax()){
            $post = Request::instance()->post();
            $house_id = $post['house_id'];
            $status = $post['status'];
            $house_info = Db::name('house_reserve')->where(['id'=>$house_id])->find();
            if(!$house_info){
                $this->error('参数错误,信息不存在');
            }
            if($status < 0 || $status > 2){
                $this->error('房间状态值错误');
            }elseif($house_info['status'] == $status){
                $this->success('修改成功');
            }
            $res = Db::name('house_reserve')->where(['id'=>$house_id])->update(['status' => $status]);

            if($res){
                $this->success('修改成功');
            }else{
                $this->error('修改失败,请重新操作');
            }
        }else{
            $this->error('非法请求');
        }
    }
}
