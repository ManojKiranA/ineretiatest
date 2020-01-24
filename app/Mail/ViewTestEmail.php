<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ViewTestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Set the subject for the message.
     *    
     * @return string
     */
    public $subject = 'My Subject From Public Property';

    /**
     * The "to" recipients of the message.
     *
     * @var array
     */
    public $to = [
        [
            'address' => 'spytomailone@gmail.com', 
            'name' => 'Spy TO Email One',
        ],
        [
            'address' => 'spytomailtwo@gmail.com', 
            'name' => 'Spy TO Email Two',
        ],
    ];

    /**
     * The "cc" recipients of the message.
     *
     * @var array
     */
    public $cc = [
        [
            'address' => 'spyccemailone@gmail.com', 
            'name' => 'Spy CC Email One',
        ],
        [
            'address' => 'spyccemailtwo@gmail.com', 
            'name' => 'Spy CC Email Two',
        ],
    ];

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
     * The "reply to" recipients of the message.
     *
     * @var array
     */
    public $replyTo = [
        [
            'address' => 'spyreplyemailone@gmail.com', 
            'name' => 'Spy Reply Email One',
        ],
        [
            'address' => 'spyreplyemailtwo@gmail.com', 
            'name' => 'Spy Reply Email Two',
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
