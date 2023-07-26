<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function mailTest(){
        
        return view('contents.mail_test');
    }
    
    public function mailSend(Request $request){
            //dd($request->all());
            Mail::to($request->sene_mail_address)
            ->bcc('webmaster@localhost.localdomain')
            ->send(new TestMail($request));
            
            return redirect('./');
            
    }
}
