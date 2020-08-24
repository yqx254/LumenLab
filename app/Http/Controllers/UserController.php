<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Utils\CommonUtils;

class UserController extends  Controller {
        public function __construct(){
            //指定类内方法要经过的路由
            $this->middleware('mid');
            //指定方法使用指定路由
            $this->middleware('log',['only'   => 'log']);
            //指定方法不使用指定路由
            $this->middleware('exception',['except'   => 'except1']);
        }

        public function index(Request $request, $id = null){
            if(empty($id)){
                echo 'No user id!!!';
            }
            else{
                echo $id;
            }

        }

        public function show(Request $request){
            echo json_encode($request->input('data','nothing'));
        }

        public function show1(Request $request){
            echo route('detail');
        }

        public function show2(Request $request){
            return redirect()->route('detail');
        }

        public function log(Request $request){
            echo "Some of my log";

            return CommonUtils::jsonResponse(1,["data"  => "和啊哈"]);
        }

        public function except1(Request $request){
            echo 'Exception!';
        }
}