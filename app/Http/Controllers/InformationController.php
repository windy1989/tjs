<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InformationController extends Controller {
    
    public function howToBuy()
    {
        $data = [
            'title'   => 'How To Buy',
            'content' => 'information.how_to_buy'
        ]; 

        return view('layouts.index', ['data' => $data]);
    }

    public function privacyPolicy()
    {
        $data = [
            'title'   => 'Privacy Policy',
            'content' => 'information.privacy_policy'
        ]; 

        return view('layouts.index', ['data' => $data]);
    }

    public function contact(Request $request)
    {
        if($request->has('_token') && session()->token() == $request->_token) {
            Mail::send([], [], function($mail) use ($request) {
                $mail->to('smartmarbleandbath@gmail.com', 'Smart Marble');
                $mail->subject($request->subject);
                $mail->from($request->email, $request->name);
                $mail->setBody('
                    <center>
                        <h5>Contact Email By ' . $request->name . '</h5>
                    </center>
                    <br><br>
                    <div>Name : ' . $request->name . '</div>
                    <div>Phone : ' . $request->name . '</div>
                    <div>Email : ' . $request->email . '</div>
                    <div>Subject : ' . $request->subject . '</div>
                    <div>Message : ' . $request->message . '</div>
                ');
            });

            return redirect()->back()->with(['success' => 'Your message has been sent']);
        }

        $data = [
            'title'   => 'Contact',
            'content' => 'information.contact'
        ]; 

        return view('layouts.index', ['data' => $data]);
    }

    public function store()
    {
        $data = [
            'title'   => 'Store',
            'content' => 'information.store'
        ]; 

        return view('layouts.index', ['data' => $data]);
    }

    public function aboutUs()
    {
        $data = [
            'title'   => 'About Us',
            'content' => 'information.about_us'
        ]; 

        return view('layouts.index', ['data' => $data]);
    }

    public function termsOfDelivery()
    {
        $data = [
            'title'   => 'Terms Of Delivery',
            'content' => 'information.terms_of_delivery'
        ]; 

        return view('layouts.index', ['data' => $data]);
    }

}
