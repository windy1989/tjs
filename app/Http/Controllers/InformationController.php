<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller {
    
    public function privacyPolicy()
    {
        $data = [
            'title'   => 'Privacy Policy',
            'content' => 'information.privacy_policy'
        ]; 

        return view('layouts.index', ['data' => $data]);
    }

    public function termsAndConditions()
    {
        $data = [
            'title'   => 'Terms & Conditions',
            'content' => 'information.terms_and_conditions'
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

    public function contact()
    {
        $data = [
            'title'   => 'Contact',
            'content' => 'information.contact'
        ]; 

        return view('layouts.index', ['data' => $data]);
    }

}
