<?php

namespace App\Http\Controllers;

use App\Http\Services\LocationSeparator;
use App\Models\SeekerProfile;
use App\Models\skill;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    public function search(Request $request)
    {

        $skills = skill::get();
        $seekers = SeekerProfile::select('college', 'location')->distinct()->get();

        $location = new LocationSeparator();
        $uniqueLocations = $location->trim($seekers);

        $query = $this->filter($request);
        $users = $query->paginate(5);

        return view('recruiter.userSearch',
        ['users'=>$users,
            'seekers'=>$seekers,
            'skills'=>$skills,
            'location'=>$uniqueLocations,
            ]
        );
    }

    public function filter($request){

        return SeekerProfile::query()->where('status',0)->with('skill')

        ->when($request->location, function ($query, $location) {
            $get = new LocationSeparator();
            $get->finder($query, $location);
        })

        ->when($request->college, function ($query, $college) {
                $query->where('college', $college);
        })

        ->when($request->skill, function ($query, $skill){
            $query->whereHas('skill', function ($query) use ($skill) {
                $query->where('id', $skill);
            });
        });

    }
}
