<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class CaseCollection extends ResourceCollection {
    public function toArray($request){
        return [
            'result'    => 1,
            'data'  => $this->collection,
            'msg'   => '查询成功'
        ];
    }
}