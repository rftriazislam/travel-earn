<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use App\Contact;
use Auth;

class FrontendController extends Controller
{

    public function index()
    {
        return view('frontend.pages.home');
    }
    public function register(Request $request)
    {

        $request->validate([
            'register_type' => ['required', 'string'],
            'country_code' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->country_code = $request->input('country_code');
        $user->register_type = $request->input('register_type');

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('register');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function ContactInfo(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',],
            'message' => ['required', 'string'],
            'subject' => ['required', 'string'],

        ]);
        $contact_add = new Contact();
        $contact_add->name = $request->name;
        $contact_add->phone = $request->phone;
        $contact_add->email = $request->email;
        $contact_add->subject = $request->subject;
        $contact_add->message = $request->message;
        $contact_add->save();
        return back()->with('message', 'Please wait Our message');
    }

    public function service()
    {
        return view('frontend.pages.service');
    }
    public function product()
    {
        return view('frontend.pages.product');
    }
    public function TermsCondition()
    {
        return view('frontend.pages.terms_condition');
    }
    public function PrivacyPolicy()
    {
        return view('frontend.pages.privacy_policy');
    }
}