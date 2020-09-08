<?php


namespace App\Model;


use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model {
    public $timestamps = false;
    protected $table = "bj_case";
    protected $perPage = 20;
    //对模型参数进行类型转换
    protected $casts = [
        'delete_flag'   => 'boolean',
    ];
    protected static function boot(){
        parent::boot();
        self::addGlobalScope('softDelete',function(Builder $builder){
            $builder->where('delete_flag',0);
        });
    }

    public function users(){
        return $this->belongsTo('App\Model\Users','create_id');
    }

    //获取client_name时进行前置操作的 访问器
    public function getClientNameAttribute($value){
        return "姓名:". $value;
    }
    //获取good_param时进行前置操作的 访问器（注意，这个变量在模型中不存在，所以没办法作为参数传入）
    public function getGoodParamAttribute(){
        return $this->attributes['client_name'] . " in our case";
    }
    //设置client_name时进行前置操作的 修改器
    public function setClientNameAttribute($value){
        $this->attributes['client_name'] = strtolower($value);
    }
}