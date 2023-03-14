<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPost;
use App\Models\RecruiterProfile;
use App\Models\SeekerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use MongoDB\Driver\Session;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user =Auth::user();
        $applications = Application::whereHas('seekerProfile', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with('jobPost','seekerProfile')
            ->get();

            return view('seeker.applied',
                [
                    'applications' => $applications,
                ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id):RedirectResponse
    {
        $seeker = SeekerProfile::where('user_id', Auth::user()->id)->first();
        $postId = JobPost::where('uuid',$id)->first();
        $exist = Application::where('post_id',$postId->id)->where('seeker_id',$seeker->id)->first();
        if($exist){
            session()->flash('message','You have already applied to the job');
        }
        else {
            $applied = Application::create([
                'post_id' => $postId->id,
                'seeker_id' => $seeker->id,
                'status' => 'applied',
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
    public function show(string $id): View
    {
        $user =Auth::user();
        $uuid = JobPost::where('uuid', $id)->first();
        $recruiter = RecruiterProfile::where('user_id',$user->id)->first();

        $applications = Application::where('status','!=','rejected')
        ->where('post_id',$uuid->id)
        ->whereHas('jobPost', function ($query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })
            ->with('jobPost','seekerProfile')
            ->get();
        return view('recruiter.applicant',
            [
                'applications' => $applications,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):RedirectResponse
    {
        $appUpdate = Application::findOrfail($id);
        $appUpdate->update([
            'status' => 'rejected',
        ]);
        return redirect()->route('application.show', $appUpdate->post_id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {
        $appUpdate = Application::findOrfail($id);

        if($request->link){
            $appUpdate->update([
                'link'=> $request->link,
            ]);
        }
        else{
            $appUpdate->update([
                'status' => 'selected',
            ]);
        }
        return redirect()->route('application.show', $appUpdate->post_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Application::where('id', $id)->delete();
    }
}
