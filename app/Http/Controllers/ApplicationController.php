<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPost;
use App\Models\RecruiterProfile;
use App\Models\SeekerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user =Auth::user();
        $applications = Application::whereHas('seekerProfile', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with('jobPost','seekerProfile')
            ->get();

        if($user->role == "seeker") {
            return view('seeker.applied',
                [
                    'applications' => $applications,
                ]);
        }
        else{
            $recru = RecruiterProfile::where('user_id',$user->id)->first();

            $applications = Application::whereHas('jobPost', function ($query) use ($recru) {
                $query->where('recruiter_id', $recru->id);
            })
                ->with('jobPost','seekerProfile')
                ->get();
            return view('recruiter.applicant',
                [
                    'applications' => $applications,
                ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {


        $seeker = SeekerProfile::where('user_id', Auth::user()->id)->first();
        $postid = JobPost::where('uuid',$id)->first();
        $exist = Application::where('post_id',$postid->id)->where('seeker_id',$seeker->id)->first();
        if($exist){
            session()->flash('message','You have already applied to the job');
        }
        else {
            $applied = Application::create([
                'post_id' => $postid->id,
                'seeker_id' => $seeker->id,
            ]);
        }

        return redirect()->route('display', $id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $appUpdate = Application::findOrfail($id);

        if($request->link){
            $appUpdate->update([
                'link'=> $request->link,
            ]);
        }
        else {
            $appUpdate->update([
                'status' => 1,
            ]);
        }

        return redirect()->route('application.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
