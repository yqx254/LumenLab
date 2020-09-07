<?php


namespace App\Http\Controllers;


use App\Exceptions\MyException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ExceptionController extends Controller {
    //异常试玩
    public function exceptionIndex(Request $request){
        throw new MyException();
    }
}