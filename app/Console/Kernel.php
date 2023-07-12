<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // 每隔一个小时执行一遍
        $schedule->command('larabbs:calculate-active-user')->hourly();
        // 每日零时执行一次
        $schedule->command('larabbs:sync-user-actived-at')->dailyAt('00:00');
        //每天凌晨执行任务

            // $schedule->call(function () {

            //     DB::table('recent_users')->delete();

            // })->daily();
        //测试
        $schedule->call(function(){
            DB::table('warehouses')->where('id',1)->increment('plate_count');
            // DB::table('warehouses')->where('id',1)->update(['plate_count'=>3]);
        })->everyMinute();
         }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
