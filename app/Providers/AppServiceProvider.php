<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail; // Tambahan 1
use Illuminate\Notifications\Messages\MailMessage; // Tambahan 2
use Illuminate\Support\HtmlString; // Tambahan 3 untuk Logo

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Kustomisasi Email Verifikasi
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Alamat Email - LAKID Kepri') // Judul Email
                ->greeting('Halo, ' . $notifiable->name . '!') // Sapaan Nama User
                
                ->line('Terima kasih telah mendaftar di Layanan Kekayaan Intelektual Digital (LAKID) Dinas Pariwisata Provinsi Kepulauan Riau.')
                ->line('Mohon klik tombol di bawah ini untuk mengaktifkan akun Anda:')
                ->action('Verifikasi Email Saya', $url) // Tombol
                ->line('Jika Anda tidak merasa mendaftar di website ini, abaikan pesan ini.')
                ->salutation('Hormat Kami, Admin LAKID');
        });
    }
}

