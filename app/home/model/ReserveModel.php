<?php
namespace app\home\model;
use think\Validate;

//在线预定数据验证
class ReserveModel extends Validate {
    protected $rule = [
        'house_num' => 'number|between:1,5',
        'contact' => 'require|max:25',
        'phone' => 'require|max:11',
    ];
    protected $message = [
        'house_type.number' => '房间类型必须是数字',
        'house_type.between' => '房间类型范围错误',
        'house_num.number' => '预定房间数必须是数字',
        'house_num.between' => '预定房间数只能在1-5之间',
        'contact.require' => '联系人不能为空',
        'contact.max' => '联系人最多25个字符',
        'phone.require' => '手机号不能为空',
        'phone.max' => '联系电话最多11位',

    ];

}