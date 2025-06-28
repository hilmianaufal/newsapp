<?php
namespace App\Notifications;

use App\Models\Komentar;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class KomentarBaru extends Notification
{
    use Queueable;

    protected $komentar;

    /**
     * Create a new notification instance.
     */
    public function __construct(Komentar $komentar)
    {
        $this->komentar = $komentar;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // bisa kirim lewat email dan simpan di database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Komentar Baru pada Artikel #' . $this->komentar->artikel_id)
            ->line('Komentar baru dari: ' . $this->komentar->nama)
            ->line('Isi komentar: "' . $this->komentar->pesan . '"')
            ->action('Lihat Artikel', url('/artikel/' . $this->komentar->artikel_id))
            ->line('Terima kasih telah menggunakan aplikasi kami.');
    }

    /**
     * Get the array representation of the notification (for database).
     */
    public function toArray($notifiable)
    {
    return [
        'nama' => $this->komentar->nama,
        'pesan' => $this->komentar->pesan,
        'link' => route('detail', $this->komentar->artikel->slug),
        'waktu' => now(),
    ];
    }   

}
