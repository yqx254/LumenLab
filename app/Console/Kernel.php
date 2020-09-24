<?php

namespace App\Console;

use App\Jobs\MailJob;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule){
        //使用call提交任务并设定提交频率，有调用命令类和闭包两种形式
//        $schedule->call(new Command)->daily();
//        $schedule->call(function(){
//           DB::truncate("table");
//        })->daily();

        //使用command，有直接填写命令和填写命令类+参数数组两种形式
//        $schedule->command("command Param --force")->daily();
//        $schedule->command(Command::class,["Param","--force"])->daily();

        //提交队列任务（等于dispatch）
//        $schedule->job(new MailJob)->everyMinute();
        //执行命令
        $schedule->exec("php artisan ")->everyMinute();
        //常见钩子
        $schedule->command("some command")
            ->everySixHours()
            ->withoutOverlapping()
            ->sendOutputTo("/storage/logs/schedule.log")
            ->emailOutputOnFailure("ravix254@outlook.com")->before(function(){
                //任务之前做的操作
            })->after(function(){
                //任务之后做的操作
            });
    }
}
