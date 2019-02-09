<?php

namespace App\Console;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Posting\PostingController;
use App\Http\Models\Post\Post;
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

    private $post;

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    public function __construct()
    {
        $post = Post::where('status', 0)
            ->with('files')
            ->first();

        $this->setPost($post);

        Post::where('id',$post['id'])->update([
            'status' => 1
        ]);
    }

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
            (new PostingController())->posting($this->getPost());
            (new PostingController())->postingOk($this->getPost());
            (new PostingController())->postingFb($this->getPost());
        })->twiceDaily(7, 8)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->posting($this->getPost());
            (new PostingController())->postingOk($this->getPost());
            (new PostingController())->postingFb($this->getPost());
        })->twiceDaily(9, 10)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->posting($this->getPost());
            (new PostingController())->postingOk($this->getPost());
            (new PostingController())->postingFb($this->getPost());
        })->twiceDaily(12, 14)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->posting($this->getPost());
            (new PostingController())->postingFb($this->getPost());
            (new PostingController())->postingOk($this->getPost());
        })->twiceDaily(16, 18)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');


        $schedule->call(function()
        {
            (new PostingController())->posting($this->getPost());
            (new PostingController())->postingOk($this->getPost());
            (new PostingController())->postingFb($this->getPost());
        })->twiceDaily(19, 21)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');

        $schedule->call(function()
        {
            (new PostingController())->posting($this->getPost());
            (new PostingController())->postingOk($this->getPost());
            (new PostingController())->postingFb($this->getPost());
        })->twiceDaily(22, 23)->timezone('Europe/Moscow')->unlessBetween('2:00', '6:00');

//        $schedule->call(function()
//        {
//            (new PostingController())->posting();
//        })->everyMinute();

        $schedule->call(function()
        {
            (new PostingController())->posting($this->getPost());
            (new PostingController())->postingOk($this->getPost());
            (new PostingController())->postingFb($this->getPost());
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
