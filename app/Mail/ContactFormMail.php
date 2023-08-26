<?php
// app/Mail/ContactFormMail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
  use Queueable, SerializesModels;
  
  public $body;
  public $email;
  public $subject;
  public $name;
  
  public function __construct( $body, $email, $subject, $name )
  {
    $this->body = $body;
    $this->email = $email;
    $this->subject = $subject;
    $this->name = $name;
  }
  
  public function build()
  {
    return $this->from( $this->email )
                ->subject( $this->subject )
                ->view( 'emails.contact-form', [ 'body' => $this->body, 'name' => $this->name ] );
  }
}
