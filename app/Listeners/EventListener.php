<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\feebbackMail;
use App\Events\feedbackSubmit;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(feedbackSubmit $event)
    {
        $email= $event->$inputData['email'];

        Mail::send('email',array('name'=>$event->$inputData['name'],
                                'feedback' => $event->$inputData['feedbackCont']),
        function($message){
            $message->from('mtbrockster@gmail.com');
            $message->to('$email');
            $message->attach('storage/app/',array('as'=>'$event->$inputData['filename']',
                                                    'mime'=>'application/txt'));            
        });
    }
}
