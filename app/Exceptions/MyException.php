<?php


namespace App\Exceptions;


class MyException extends \Exception{
    //此异常抛出时如何报告异常
    public function report(){
        \Log::error("1111");
    }

    //异常抛出时如何向浏览器端反馈
    public function render($request){
        return failedJson(500,"record not found!!!");
    }
}