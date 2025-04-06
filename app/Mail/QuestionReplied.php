<?php

namespace App\Mail;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionReplied extends Mailable 
{
    use Queueable, SerializesModels;

    public $questionOwner;
    public $replier;
    public $question;

    /**
     * Create a new message instance.
     *
     * @param User $questionOwner
     * @param User $replier
     * @param Question $question
     */
    public function __construct(User $questionOwner, User $replier, Question $question)
    {
        $this->questionOwner = $questionOwner;
        $this->replier = $replier;
        $this->question = $question;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Someone replied to your question')
                    ->view('emails.questions.replied'); // You can create a view for the email body
    }
}
