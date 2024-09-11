<?php

namespace App\mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function build()
    {
        return $this->subject('Welcome to Laravel App')
                    ->view('mail.welcome')->with('name',$this->name);
    }
}
