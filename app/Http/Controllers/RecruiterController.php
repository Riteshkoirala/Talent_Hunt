<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\SeekerProfile;
use App\Models\skill;
use Illuminate\Http\Request;
use PHPUnit\Event\Test\Skipped;

class RecruiterController extends Controller
{
    public function search(Request $request){

        $skills = skill::get();
        $seekers = SeekerProfile::select('location', 'college')->distinct()->get();

        $query = $this->filter($request);
        $users = $query->paginate(5);

        return view('recruiter.userSearch',
        ['users'=>$users,
            'seekers'=>$seekers,
            'skills'=>$skills,
            ]
        );
    }

    public function filter($request){

        $query = SeekerProfile::where('status',0)->with('skill')
        ->when($request->location, function ($query, $location) {
            $query->where('location', $location);
        })
        ->when($request->college, function ($query, $college) {
                $query->where('college', $college);
        })
        ->when($request->skill, function ($query, $skill){
            $query->whereHas('skill', function ($query) use ($skill) {
                $query->where('id', $skill);
            });
        });

        if($request->location && $request->college){
                $query->where('college', $request->college)
                    ->where('location', $request->location);
        }
        if ($request->location && $request->skill) {
            $query->whereHas('skill', function ($query) use ($request) {
                $query->where('id', $request->skill);
            })
              ->where('location', $request->location);

        }
        if ($request->college && $request->skill) {
            $query->whereHas('skill', function ($query) use ($request) {
                $query->where('id', $request->skill);
            })
                ->where('college', $request->college);

        }

        if ($request->location && $request->college && $request->skill) {
            $query->whereHas('skill', function ($query) use ($request) {
                $query->where('id', $request->skill);
            })
                ->where('college', $request->college)
                ->where('location', $request->location);
        }

        return $query;

    }
}
