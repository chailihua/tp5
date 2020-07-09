<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\home\model\ReserveModel;

//在线预订
class Reserve extends Controller
{
    //首页
    public function index()
    {
        $house_type = Db::table('web_house_type')->where(['is_valid'=>1])->select();
        //允许预定三个月之内的客房
        $minDate = date('Y-m-d');
        $maxDate = date('Y-m-d',strtotime('+3 month'));
        $this->assign([
            'house_type'  => $house_type,
            'minDate'  => $minDate,
            'maxDate'  => $maxDate,
        ]);
        // 模板输出
        return $this->fetch('index');
    }

    //预定
    public function reserve()
    {
        if(request()->isAjax()){
            $max_type = Db::table('web_house_type')->where(['is_valid'=>1])->order('type desc')->value('type');
            $min_type = Db::table('web_house_type')->where(['is_valid'=>1])->order('type asc')->value('type');
            $post = Request::instance()->post();

            $validate = new ReserveModel([
                'house_type'   => 'number|between:'.$min_type.','.$max_type,
            ]);

            $data=[
                'house_type'=> $post['house_type'],
                'house_num'=> $post['house_num'],
                'contact' => $post['contact'],
                'phone'=> $post['phone'],
            ];

            if(!$validate->check($data)) {
                $this->error($validate->getError());
            }

            $error = '';
            $reg = '/^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[0-1]|)$/';
            $reg_phone = '/^\d{6,11}$/';
            if(!preg_match($reg, $post['start_date'])){
                $error = '入住时间格式错误';
            }elseif(strtotime($post['start_date']) < strtotime("-1 day")){
                $error = '入住时间请选择今天及以后'.$post['start_date'].strtotime("-1 day");
            }elseif(!preg_match($reg, $post['end_date'])){
                $error = '退房时间格式错误';
            }elseif(strtotime($post['start_date']) > strtotime($post['end_date'])){
                $error = '入住时间不能大于退房时间';
            }elseif(count($post) > 7){
                $error = '数据格式错误';
            }elseif(!preg_match($reg_phone,  $post['phone'])){
                $error = '联系电话请填写6-11位数字';
            }

            if($error){
                $this->error($error);
            }

            $res = Db::table('web_house_reserve')->insert($post);

            if($res){
                $this->success('提交成功');
            }else{
                $this->error('提交失败,请重新操作');
            }
        }else{
            $this->error('非法请求');
        }
    }
}
