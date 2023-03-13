<?php

namespace App\Http\Controllers;

use App\Http\Services\LocationSeparator;
use App\Models\JobPost;
use App\Models\JobType;
use App\Models\RecruiterProfile;
use App\Models\SeekerProfile;
use App\Models\skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SeekerController extends Controller
{

    public function index(Request $request)
    {

        $logUser = SeekerProfile::where('user_id', Auth::user()->id)->first();

        $skill = Skill::get();
        $type = JobType::get();
        $company = RecruiterProfile::get();
        $seekers= JobPost::select('location')->distinct()->get();

        $location = new LocationSeparator();
        $uniqueLocations = $location->trim($seekers);

        if (!$logUser) {
            return redirect()->route('profiles.create');
        }
        $query = $this->filter($request);

        $postData = $query->latest('created_at')->paginate(5);
            return view('seeker.dashboard', [
                'posts' => $postData,
                'skill'=>$skill,
                'type'=>$type,
                'location'=>$uniqueLocations,
                'company'=>$company,
            ]);
    }

    public function filter($request){

        $query = JobPost::with('recruiterProfile', 'postSkill', 'jobType')
                ->when($request->location, function ($query, $location) {
                    $get = new LocationSeparator();
                    $get->finder($query, $location);
                })
                ->when($request->company, function ($query, $company) {
                    $query->whereHas('recruiterProfile', function ($query) use ($company) {
                        $query->where('company_name', $company);
                    });
                })
                ->when($request->type, function ($query, $type) {
                    $query->where('type_id', $type);
                })
                ->when($request->skill, function ($query, $skill) {
                    $query->whereHas('postSkill', function ($query) use ($skill) {
                        $query->where('id', $skill);
                    });
                });

            return $query;

        }






}
