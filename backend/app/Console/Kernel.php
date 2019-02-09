<?php

namespace App\Console;

use App\Http\Controllers\Posting\InstagrammController;
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
            (new PostingController())->wallAllPosting();
        })->twiceDaily(7, 8)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->wallAllPosting();
        })->twiceDaily(9, 10)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->wallAllPosting();
        })->twiceDaily(12, 14)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->wallAllPosting();
        })->twiceDaily(16, 18)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->wallAllPosting();
        })->twiceDaily(19, 21)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');

        $schedule->call(function()
        {
            (new PostingController())->wallAllPosting();
        })->twiceDaily(22, 23)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');

        $schedule->call(function()
        {
            (new InstagrammController())->sendInstagramm();
        })->everyMinute();

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
