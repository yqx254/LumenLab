<?php


namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ExceptionController extends Controller {
    //异常试玩
    public function exceptionIndex(Request $request){
        try{
            $a = 1;
            throw new ModelNotFoundException();
            return 1;
        }
        catch (\Exception $e){
            return 0;
        }
    }
}