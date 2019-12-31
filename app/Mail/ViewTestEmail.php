<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ViewTestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'My Subject From Public Property';

    /**
     * The "bcc" recipients of the message.
     *
     * @var array
     */
    public $bcc = [
        [
            'address' => 'spybccemailone@gmail.com', 
            'name' => 'Spy BCC Email One',
        ],
        [
            'address' => 'spybccemailtwo@gmail.com', 
            'name' => 'Spy BCC Email Two',
        ],
    ];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('test');
    }
}
