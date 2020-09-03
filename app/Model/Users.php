<?php


namespace App\Model;

use App\Scope\SoftDeleteScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Users extends Model{
    //表名，不覆盖则默认为类名的蛇形命名
    protected $table = "bj_user";
    //和fillable作用相反，指定不能够进行fill、create批量赋值的字段，为空表示随便赋
    protected $guarded = [];
    //是否使用框架的时间戳管理（类型是timestamp）
    public $timestamps = false;
    //默认的预加载关联
    //这个不能随便玩，例如，从case关联user而这个默认加载被打开的话，就会把user相关的case又重新加载一遍
//    protected $with = ['cases'];

    protected static function boot(){
        parent::boot();
        //匿名Scope
        static::addGlobalScope('softDelete', function (Builder $builder){
            $builder->where('delete_flag',0);
        });
        //显式Scope
        static::addGlobalScope(new SoftDeleteScope());
    }

    public function scopeAdmin($query){
        return $query->where('role_id',1);
    }

    public function roles(){
        //多对多，四个参数是 关联模型  中间表  模型的外键 关联模型的外键
        return $this->belongsToMany('App\Model\Roles','role_user_rel','user_id','role_id');
    }

    public function cases(){
        return $this->hasMany('App\Model\Cases','create_id');
    }
}