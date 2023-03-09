<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\JobType;
use App\Models\RecruiterProfile;
use App\Models\SeekerProfile;
use App\Models\skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeekerController extends Controller
{

    public function index(Request $request){

        $logUser = SeekerProfile::where('user_id',Auth::user()->id)->first();

        $skill = Skill::get();
        $type = JobType::get();
        $company = RecruiterProfile::get();
        $location = JobPost::select('location')->distinct()->get();

        if (!$logUser) {
            return redirect()->route('profiles.create');
        }
        $query = $this->filter($request);

        $postData = $query->latest('created_at')->paginate(5);
            return view('seeker.dashboard', [
                'posts' => $postData,
                'skill'=>$skill,
                'type'=>$type,
                'location'=>$location,
                'company'=>$company,
            ]);
        }

        public function filter($request){

            $query = JobPost::with('recruiterProfile', 'postSkill', 'jobType')
                ->when($request->location, function ($query, $location) {
                    $query->where('location', $location);
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

            if ($request->location && $request->company) {
                $query->whereHas('recruiterProfile', function ($query) use ($request) {
                    $query->where('company_name', $request->company);

                })->where('location', $request->location);
            }

            if ($request->type && $request->company) {
                $query->whereHas('recruiterProfile', function ($query) use ($request) {
                    $query->where('company_name', $request->company);

                })->where('type_id', $request->type);
            }
            if ($request->skill && $request->company) {
                $query->whereHas('postSkill', function ($query) use ($request) {
                    $query->where('id', $request->skill);
                })
                    ->whereHas('recruiterProfile', function ($query) use ($request) {
                        $query->where('company_name', $request->company);
                    });
            }
            if ($request->location && $request->type) {
                    $query->where('location', $request->location)
                        ->where('type_id', $request->type);
            }
            if ($request->location && $request->skill) {
                $query->whereHas('postSkill', function ($query) use ($request) {
                    $query->where('id', $request->skill);
                })
                ->where('location', $request->location);

            }
            if ($request->type && $request->skill) {
                $query->whereHas('postSkill', function ($query) use ($request) {
                    $query->where('id', $request->skill);
                })
                ->where('type_id', $request->type);

            }

            if ($request->location && $request->company && $request->type) {
                $query->whereHas('recruiterProfile', function ($query) use ($request) {
                    $query->where('company_name', $request->company);
                })
                ->where('location', $request->location)
                ->where('type_id', $request->type);
            }

            if ($request->skill && $request->company && $request->location) {
                $query->whereHas('postSkill', function ($query) use ($request) {
                    $query->where('id', $request->skill);
                })
                    ->whereHas('recruiterProfile', function ($query) use ($request) {
                        $query->where('company_name', $request->company);
                    })
                    ->where('location', $request->location);
            }
            if ($request->skill && $request->company && $request->type) {
                $query->whereHas('postSkill', function ($query) use ($request) {
                    $query->where('id', $request->skill);
                })
                    ->whereHas('recruiterProfile', function ($query) use ($request) {
                        $query->where('company_name', $request->company);


                    })
                    ->where('type_id', $request->type);
            }

            if ($request->location && $request->company && $request->skill && $request->type) {
                $query->whereHas('postSkill', function ($query) use ($request) {
                    $query->where('id', $request->skill);
                })
                    ->whereHas('recruiterProfile', function ($query) use ($request) {
                        $query->where('company_name', $request->company);
                    })
                    ->where('location', $request->location)
                    ->where('type_id', $request->type);
            }

            return $query;

        }






}
