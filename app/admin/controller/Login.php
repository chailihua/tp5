<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

//后台登录
class Login extends Controller
{
    public function login()
    {
        if(request()->isAjax()){
            $post = Request::instance()->post();
            $password = md5($post['password']);
            $employ = Db::table('web_employ')->where(['user_name'=>$post['user_name']])->find();
            if(!$post['user_name'] || !$post['password']){
                $this->error('请填写用户名和密码');
            }elseif(!$employ){
                $this->error('用户不存在');
            }elseif($password != $employ['password']){
                $this->error('密码不正确');
            }elseif($employ['status'] != 1){
                $this->error('用户状态异常');
            }
            session('uid',$employ['id']);
            $this->success('登录成功');
        }else{
            if(session('uid')){
                $this->redirect('/admin/index/index');
            }else{
                return $this->fetch();
            }
        }
    }


}
