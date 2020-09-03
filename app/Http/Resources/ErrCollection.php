<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class ErrCollection extends ResourceCollection{
    protected $errcode;
    protected $msg;
    public function __construct($resource, $errcode, $msg)    {
        parent::__construct($resource);
        $this->errcode = $errcode;
        $this->msg = $msg;
    }
    public function toArray($request)    {
        return [
            'result'    => 0,
            'data'      => [],
            'errcode'  => $this->errcode,
            'msg'       => $this->msg
        ];
    }
}