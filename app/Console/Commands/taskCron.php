<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Notifications\Info;
use App\todo;
use Illuminate\Support\Facades\Date;

class taskCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To do list Reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $date =date('Y-m-d');
        $time_now =date("H:i:s");
        $time_after =date("H:i:s",strtotime('+1 hour',strtotime($time_now)));
        $todos = todo::with('action')->where('date',$date)->whereBetween('time',array($time_now,$time_after))->get() ;
//        dd($time_now,$time_after);
//        dd($todos->toArray());;
        foreach($todos as $todo)
        {

            $user = User::find($todo->user_id);
            $details=
                [
                    'info' => 'TO DO LIST reminder',
                    'data' => 'You have a '.$todo->action->name.' at <b class="text-danger">'.date('M jS, Y', strtotime($todo->date)). '</b> on <b class="text-danger">'.date('h:i A', strtotime($todo->time)).'</b> <br><a href="http://127.0.0.1:8000/admin/calendar">View Calendar<a>',

                ];
            $user->notify(New Info($details));
        }
    }
}
