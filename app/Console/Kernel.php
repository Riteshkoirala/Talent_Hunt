<?php

namespace App\Console;

use App\Models\JobPost;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

//    protected $commands = [
//        \Illuminate\Console\Scheduling\ScheduleRunCommand::class,
//        // other commands...
//    ];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {

            $getData = JobPost::where('deadline', '<',now())->get();

            foreach ($getData as $data) {
                $data->postSkill()->detach();
                $data->application()->delete();
                $data->delete();
            }

        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
