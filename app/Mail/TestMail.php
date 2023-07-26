<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Attachment;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $request;
    protected $file;
    
    /**
     * Create a new message instance.
     */
    public function __construct($request)
    {
        //dd($request->all());
        $this->request = $request;
       // $this->file = $file;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $request = $this->request;
        
        return new Envelope(
            from: new Address('webmaster@localhost.localdomain','管理者'),
            subject: $request->send_mail_subject,
            );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            text: 'mail.test',
            with:[
                'request'=> $this->request,
            ],
            );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array // 添付ファイルを送りたいとき使う
    {
        $request = $this->request;
        return [
            Attachment::fromPath($request->add_file->getRealPath())
            ->as($request->add_file->getClientOriginalName())
            ->withMime($request->add_file->getClientMimeType()),
        ];
    }
}
