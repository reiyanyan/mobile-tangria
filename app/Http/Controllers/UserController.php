<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function loginPost(Request $request){
        $field = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $ch = curl_init('http://tangria.smkrus.com/api/user/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function registerPost(Request $request){
        $field = [
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'fcm_token' => 0,
            'password' => $request->password,
        ];
        $ch = curl_init('http://tangria.smkrus.com/api/user/signup');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function package(){
        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, "http://tangria.smkrus.com/api/product/package_treatment");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch); 
        curl_close($ch);
        return $response;
    }

    public function ala_carte(){
        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, "http://tangria.smkrus.com/api/product/ala_carte_treatment");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch); 
        curl_close($ch);
        return $response;
    }

    public function busy(){
        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, "http://tangria.smkrus.com/api/busy");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch); 
        curl_close($ch);
        return $response;
    }

    public function profile(Request $request){
        $field = [
            'id' => $request->id
        ];
        $ch = curl_init('http://tangria.smkrus.com/api/user');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function available_time(Request $request){
        $field = [
            'date' => $request->date,
            'ordername' => $request->ordername
        ];
        $ch = curl_init('http://tangria.smkrus.com/api/available-time');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function booking(Request $request){
        $field = [
            'user_id' => $request->user_id,
            'date' => $request->date,
            'order' => $request->order
        ];
        $ch = curl_init('http://tangria.smkrus.com/api/booking');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function booking_history(Request $request){
        $field = [
            'user_id' => $request->user_id
        ];
        $ch = curl_init('http://tangria.smkrus.com/api/booking/history');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}
