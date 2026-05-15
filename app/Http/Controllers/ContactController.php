<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10|max:2000',
        ]);

        try {
            // Kirim email ke admin menggunakan Mailable class
            Mail::to(config('mail.from.address', 'admin@jajansnack.com'))
                ->send(new ContactMail(
                    $validated['name'],
                    $validated['email'],
                    $validated['subject'],
                    $validated['message']
                ));

            Log::info('Contact form email sent successfully', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
            ]);

            return redirect()->route('contact')
                ->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
        } catch (\Exception $e) {
            Log::error('Failed to send contact form email', [
                'error' => $e->getMessage(),
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            return redirect()->route('contact')
                ->with('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi nanti.')
                ->withInput();
        }
    }
}
