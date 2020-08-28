<?php


namespace App\Model;

use App\Scope\SoftDeleteScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Users extends Model{
    protected $table = "bj_user";
    protected $guarded = [];
    public $timestamps = false;

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
}