<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\LuxuryContactConfirmation;

class ContactController extends Controller
{
    public function index(){
        return view('user.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:120',
            'last_name'  => 'nullable|string|max:120',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:30',
            'subject'    => 'required|string|max:255',
            'message'    => 'required|string',
            'newsletter' => 'nullable|boolean',
        ]);
    
        $message = ContactMessage::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'] ?? null,
            'email'      => $data['email'],
            'phone'      => $data['phone'] ?? null,
            'subject'    => $data['subject'],
            'message'    => $data['message'],
            'newsletter_subscription' => $data['newsletter'] ?? false,
        ]);
    

        return response()->json([
            'success' => true,
            'message' => 'Your message has been received. Our luxury consultants will contact you shortly.',
            'data' => $message
        ]);
    }
}