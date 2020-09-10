<?php


namespace App\Jobs;
use App\Mail\Sender;
use App\Model\Users;
use App\Model\Cases;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class MailJob extends Job
{
    //最多重试次数
    public $tries = 2;
    //任务可执行的最大秒数
    public $timeout = 60;

    public function __construct(){

    }

    //执行job
    public function handle(){
        $user = Users::find(1);
        $user->email = "ravix254@outlook.com";
        $case = Cases::find(48);
        Mail::to($user)->send(new Sender($case));
        Log::info("Mail send");
    }
}