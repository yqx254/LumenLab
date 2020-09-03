<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class JsonCollection extends ResourceCollection{
    protected $msg;
    public function __construct($resource,$msg){
        parent::__construct($resource);
        $this->msg = $msg;
    }

    public function toArray($request)    {
        return [
            'result'    => 1,
            'data'  => $this->collection,
            'msg'   => $this->msg
        ];
    }
}