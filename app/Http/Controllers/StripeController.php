<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    //都度払いカード情報入力
    public function stripeTest(){
        $price = 10000;
        return view('stripe.stripe_test',compact('price'));
    }
    
   //一時払い決済
    public function stripePay(Request $request){
        //dd($request->all());
        
        $payment = $request->price;
        //決済
        $request->user()->charge($payment,$request->paymentMethodId);
        return redirect(route('thanks'));
    }
    
    //サンクスページ表示
    public function thanks(){
       
        return view('stripe.stripe_thanks');
    }
    
    //サブスクありカード情報入力
    public function stripeSub(){
        $price = 0;
        
        return view('stripe.stripe_sub',['intent'=> auth()->user()->createSetupIntent()],compact('price'));
    }
    
    //サブスクあり決済（都度決済も可）
    public function stripeSubPay(Request $request){
        //dd($request->all());
        
        $payment = $request->price;
        //サブスク登録
        $request->user()->newSubscription(
            'default',$request->pay_type
            )->create($request->paymentMethodId);
        if($payment != 0){     
            
        //決済
        $request->user()->charge($payment,$request->paymentMethodId);
        }
        
        return redirect(route('thanks'));
    }
    //サブスク解除    
    public function stripeCancel(){
        $user = Auth::user();
        $subscription = $user->subscriptions()->where('stripe_status','active')->first();
        //dd($subscription);
        if($subscription){
            $output = null;
            $retval = null;
            $cmd ="curl -X DELETE https://api.stripe.com/v1/subscriptions/" . $subscription->stripe_id . " -u sk_test_51NSupdAu65RFOziFYXq8S65cPmBkErmlLMiw2dNvbg3l8tBKfmRkoeVvLxabTZCctFVYBTHnd1uwfTa8xRjAXGDr00vAHM0fTL";
           // print $cmd;
            exec($cmd,$output,$retval);
            
            
            //echo "Returned with status $retval and autput: \n";
            //print_r($output);
            
            $subscription->stripe_status = "canceld";
            $subscription->save();
            
            return redirect(route('dashboard'));
        }
        
    }
    
    //ログインなし都度決済情報入力ページ
    public function stripeNoUser(){
        $price = 3000;
        return view('stripe.stripe_no_user',compact('price'));
        
    }
    
    
    //composer のインストールしておく composer require stripe/stripe-php
    public function stripePayNoUser(Request $request){
        //dd($request->all());
        $price = $request->price;
        
        \Stripe\Stripe::setApiKey('sk_test_51NSupdAu65RFOziFYXq8S65cPmBkErmlLMiw2dNvbg3l8tBKfmRkoeVvLxabTZCctFVYBTHnd1uwfTa8xRjAXGDr00vAHM0fTL');
     
        //Stripeカスタマー作成用
     $customer = \Stripe\Customer::create([
         'email'=> $request->user_mail,
         'name' => $request->card_holder_name,
         'payment_method'=> $request->paymentMethodId,
     ]);
     
     //Stripe決済
     $charge = \Stripe\PaymentIntent::create([
         'customer' => $customer->id,
         'amount' => $price,
         'currency' =>'jpy',
         'payment_method_types' => ['card'],
         'payment_method'=> $request->paymentMethodId,
         'confirm'=>true,//即時決済
     ]);
     
     //dd($charge);
     
       return redirect(route('no_user_thanks'));
        
    }
    
    public function noUserThanks(){
        
        return view('stripe.no_user_thanks');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}






