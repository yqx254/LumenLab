<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Roles extends  Model{
    protected $table = "bj_role";
    protected $primaryKey = "role_id";
    public $timestamps = false;

    public function users(){
        return $this->hasMany('App\Model\Users','role_id');
    }
}