<?php

namespace App\Mail;

use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RentalConfirmMail extends Mailable implements ShouldQueue
{
    //processamento assíncrono
    use Queueable, SerializesModels;

    public $client;
    public $modelo;
    public $data_inicio;
    public $data_fim;
    public $preco_total;

    /**
     * Create a new message instance.
     */
    public function __construct($client, $modelo, $data_inicio, $data_fim, $preco_total)
    {
        $this->client = $client;
        $this->modelo = $modelo;
        $this->data_inicio = $data_inicio;
        $this->data_fim = $data_fim;
        $this->preco_total = $preco_total;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            /*replyTo: [new Address('taylor@example.com', 'Taylor Otwell'),],*/
            subject: 'Confirmação da Reserva Confirmation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.rental-confirm-mail',
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
        /*Exemplo:
        Com a classe Attachment, usamos os métodos para indicar:
        - o caminho do anexo,
        - o nome com o qual será enviado,
        - e o tipo MIME do arquivo (por exemplo, application/pdf para .pdf e application/msword para .doc).
        return [
            Attachment::fromPath('/path/to/file')
                ->as('name.pdf')
                ->withMime('application/pdf'),
        ];*/

    }
}
