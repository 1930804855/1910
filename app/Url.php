<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Url extends Model{
	//指定表名
	protected $table='url';
	//指定主键
	protected $primaryKey='u_id';
	//关闭时间戳
	public $timestamps =false;
	//黑名单
	protected $guarded=[];
}
?>