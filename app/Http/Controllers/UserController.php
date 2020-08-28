<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Utils\CommonUtils;
use App\Services\CustomService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Model\Users;
use App\Model\Roles;

class UserController extends  Controller {
        protected  $customService;
        public function __construct(CustomService $customService){
            $this->customService = $customService;
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
            $user = Users::where('id',1)->first();
            $roles = $user->roles;
            foreach($roles as $v){
                //使用pivot来获取中间表的字段
                $v->user_id = $v->pivot->user_id;
            }
            //最少有一个角色
            $users = Users::has('roles')->get();
            $users = Users::withCount('roles')->get();
            dd($users);
            return CommonUtils::jsonResponse(1,$roles);
        }

        public function log(Request $request){
            echo "Some of my log";
            $this->customService->customService();
            return CommonUtils::jsonResponse(1,["data"  => "和啊哈"]);
        }

        public function except1(Request $request){
            Cache::add("mykey","myvalue");
//            $res2 = DB::select('SELECT realname FROM bj_user WHERE id = :userid LIMIT 1',['userid'  => 1]);
//            echo $res2[0]->realname;
            $roleId = 2;
            $res = DB::table('bj_user')->when($roleId,
                function($query){
                return $query->where('delete_flag',0);
            },function($query, $roleId){
                return $query->where('role_id',$roleId)->where('delete_flag',0);
            })->get();
            echo count($res);
            echo Cache::get("mykey");
        }
}