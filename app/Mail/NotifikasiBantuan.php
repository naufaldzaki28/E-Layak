<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiBantuan extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Variabel untuk menampung data pesan

    public function __construct($data)
    {
        $this->data = $data; // Masukkan data ke variabel class
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesan Baru dari Layanan Bantuan', // Judul Email
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bantuan', // Nama file tampilan email (kita buat setelah ini)
        );
    }
}
