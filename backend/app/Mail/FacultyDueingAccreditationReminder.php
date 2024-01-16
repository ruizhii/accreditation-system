<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FacultyDueingAccreditationReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $faculty = null;

    /**
     * Create a new message instance.
     */
    public function __construct($faculty)
    {
        $this->faculty = $faculty;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Expiring Accreditation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $departments = $this->faculty->departments()->whereHas('academic_programmes.accreditations', function($q) {
            $q->where('expiry_date', '<', Carbon::now());
        });

        return new Content(
            view: 'emails.faculty-dueing-accreditation-reminder',
            with: array($this->faculty, $departments),
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
