<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Routing\Controller;


use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function edit(){

        $id = 1;
        $userId = 1; 

        $contacts = Contacts::firstOrCreate(['id'=>$id, 'user_id'=>$userId]);

        return view('profile.contacts')->with('contacts',$contacts);
    }

    public function submit(Request $q){

        $inputs = $q->input();

        $id = 1;
        $userId = 1; 

        $email = $inputs['email'];
        $fullName = $inputs['full_name'];
        $link = $inputs['link'];
        $address = $inputs['address'];
        $phone = $inputs['phone_number'];

        Contacts::updateOrCreate(['id'=>$id, 'user_id'=>$userId], [
            'email' =>$email,
            'link'=>$link,
            'address'=>$address,
            'phone_number'=>$phone,
            'full_name'=> $fullName
        ]);

        return redirect('/');

    }
}
