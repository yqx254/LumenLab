<?php


namespace App\Http\Controllers;


use App\Http\Resources\CaseCollection;
use Illuminate\Http\Request;
use App\Utils\CommonUtils;
use App\Services\CustomService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Model\Users;
use App\Model\Roles;
use App\Model\Cases;
use App\Http\Resources\Cases AS CaseResource;

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
        //试玩user case一对多关联
        public function show1(Request $request){
            //这个方法会导致每一个user都自己查case，弄出很多条查询语句来
            //$user = Users::all();
            //with预加载
            //with => 闭包，对预加载进行筛选
            $user = Users::with(['cases'    => function($query){
                $query->where('status',1);
            }])->get();
            foreach($user as $val){
                foreach($val->cases as $v){
                    echo $v->client_name;
                }
            }
            return CommonUtils::jsonResponse(1);
        }
        //试玩user role多对多关联
        public function show2(Request $request){
            $user = Users::where('id',1)->first();
            $roles = $user->roles;
            foreach($roles as $v){
                //使用pivot来获取中间表的字段
                $v->user_id = $v->pivot->user_id;
            }
            //最少有一个角色
            $users = Users::has('roles')->get();
            //不加载关联数据但进行聚合统计噢，好腻害
            $users = Users::withCount('roles')->get();
            dd($users);
            return CommonUtils::jsonResponse(1,$roles);
        }

        //试玩集合类各种功能
        public function caseCollections(Request $request){
            $cases = Cases::all();
            //是否包含主键或模型
            $cases->contains(48);
            $cases->contains(Users::find(48));

            //不在给定集合中
            $case1 = $cases->diff(Cases::whereIn('id',[48,49,50])->get());

            //不等于指定主键
            $case2 = $cases->except([48,49]);

            //查指定主键
            $case3 = $cases->find([48,49]);

            //用同样的条件更新模型实例，可以接受with参数预加载关联关系
            $case4 = $cases->fresh();

            $case5 = $cases->intersect(Cases::whereIn('id',[48,49,50])->get());

            $case6 = $cases->modelKeys();

            $case7 = $cases->makeHidden(['client_name']);

            $case8 = Cases::find(48);
//            $case8->client_name = "Tomcat";
//            $case8->save();
            $case9 = CaseResource::collection(Cases::all());
            $case10 = Cases::with('users:id,user_name,realname,role_id')->find(48);
            $case11 = DB::table('bj_case')->where('id',48)->first();
            $case10 = $case10->makeHidden(['status','create_name']);
            return successJson($case10);
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