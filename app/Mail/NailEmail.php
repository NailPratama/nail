<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
class NailEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $var_slug;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($slug)
    {
        //
        $this->var_slug = $slug;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $slug = Auth::user()->slug_coverimage;
        // ddd($this->var_slug);
         return $this->from('diffex@mail.com')
                    ->view('link', [
                        "slug" => $this->var_slug
                    ])
                    ->with(
                        [
                            
                            'website'=>$this->var_slug,
                        ]
                    );
    }
}
