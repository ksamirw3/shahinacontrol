<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CouchModel;
use Mail;

class SendEmails extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send {user} {view} {subject} {array} {replay?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $model;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(\App\Models\CouchModel $model) {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        //
        $view = $this->argument("view");
        $arr = $this->argument("array");
        $id = $this->argument("user");
        $subject = $this->argument("subject");
        $data = $this->model->find($id);
        $email = $data->email;
        $name = $data->name;
        if (empty($this->argument('replay'))) {
                Mail::queue($view, $arr, function ($mail) use ($email, $name, $subject) {
                    $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                    $mail->to($email, $name)->subject($subject);
                });
        } else {
        $replay = $this->argument('replay');
        $data2= $this->model->find($replay);
                Mail::queue($view, $arr, function ($mail) use ($data2, $data,$subject) {
                    $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
                    $mail->to($data->email, $data->name)
                    ->replayTo($data2->email, $data2->name)
                            ->subject($subject);
                });   
        }
    }

}
