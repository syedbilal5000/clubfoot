<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailController extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient, $path_file)
    {
        // $this->name = $name;
        $this->patient = $patient;
        $this->path_file = $path_file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd(1234);
        // $data = ["name" => $this->name];
        $data = ["patient" => $this->patient, "path_file" => $this->path_file];
        return $this->from('contact@smartrounder.com')
                ->view('mail.mail_table')->with($data);
    }
}
