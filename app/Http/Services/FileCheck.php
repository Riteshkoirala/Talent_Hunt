<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FileCheck
{

    public function checkPhoto($request){
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $filename = now().$filename;
        if(Auth::user()->role == "recruiter") {
            $file->move(public_path('images/recruiter'), $filename);
        }
        else {
            $file->move(public_path('images/seeker'), $filename);
        }
        return $filename;
    }

    public function checkCv($request){
        $file = $request->file('cv');
        $filename = $file->getClientOriginalName();
        $filename = now().$filename;
        $file->move(public_path('cv'), $filename);
        return $filename;
    }

}
