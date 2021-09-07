<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSended extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $mail_subject;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->mail_subject = $request->mail_subject;
        $this->message = $request->message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Vocë recebeu um contato com o assunto: ' . $this->mail_subject)
            ->markdown('emails.contact.email')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->mail_subject,
                'message' => $this->message,
            ]);
    }
}
