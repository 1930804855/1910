<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Register extends Model{
	//指定表名
	protected $table='register';
	//关闭时间戳
	public $timestamps =false;
	//黑名单
	protected $guarded=[];
}
?>