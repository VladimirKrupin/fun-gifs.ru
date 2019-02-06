<?php

namespace App\Console;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Posting\PostingController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
    protected function schedule(Schedule $schedule)
    {
//        $schedule->call(function()
//        {
//            (new UserController())->createUser();
//        })->everyMinute();

        $schedule->call(function()
        {
            (new PostingController())->posting();
        })->twiceDaily(6, 7)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->posting();
        })->twiceDaily(8, 9)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->posting();
        })->twiceDaily(12, 14)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->posting();
        })->twiceDaily(16, 18)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->posting();
        })->twiceDaily(19, 20)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');

        $schedule->call(function()
        {
            (new PostingController())->posting();
        })->twiceDaily(21, 22)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');

        $schedule->call(function()
        {
            (new PostingController())->posting();
        })->twiceDaily(0, 23)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');

//        $schedule->call(function()
//        {
//            (new PostingController())->postingOk();
//        })->everyMinute();

//        $schedule->call(function()
//        {
//            (new PostingController())->postingFb();
//        })->everyMinute();

//        $schedule->call(function()
//        {
//            (new PostingController())->test();
//        })->everyMinute();


    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
