<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // Kirim email ke admin (gunakan MAIL_FROM_ADDRESS sebagai tujuan)
        Mail::raw(
            "Pesan dari: {$validated['name']} <{$validated['email']}>\n\n" .
            "Subjek: {$validated['subject']}\n\n" .
            $validated['message'],
            function ($mail) use ($validated) {
                $mail->to(config('mail.from.address', 'admin@jajansnack.com'))
                     ->replyTo($validated['email'], $validated['name'])
                     ->subject('[JajanSnack Kontak] ' . $validated['subject']);
            }
        );

        return redirect()->route('contact')
            ->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
    }
}
