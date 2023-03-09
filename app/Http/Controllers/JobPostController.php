<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPostRequest;
use App\Models\JobPost;
use App\Models\JobType;
use App\Models\RecruiterProfile;
use App\Models\skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logUser = RecruiterProfile::where('user_id',Auth::user()->id)->first();


            if (!$logUser) {
                return view('recruiter.profile.create');
            } else {
                $postData = JobPost::where('recruiter_id', $logUser->id)
                    ->with('recruiterProfile','postSkill', 'jobType')
                    ->latest('created_at')
                    ->paginate(5);

                return view('recruiter.post.dashboard', [
                    'posts' => $postData,
                ]);
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $skills = skill::get();
        $types = JobType::get();

        return view('recruiter.post.create',
            [
                'skills'=>$skills,
                'types'=>$types,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPostRequest $request)
    {

        $recruiterid = RecruiterProfile::where('user_id',Auth::User()->id)->first();

        $request->validated();

        $post = JobPost::create([
            'uuid'=>Str::uuid(),
            'recruiter_id'=>$recruiterid->id,
            'title'=>$request->title,
            'location'=>$request->location,
            'deadline'=>$request->deadline,
            'type_id'=>$request->type,
            'qualification'=>$request->qualification,
            'experience'=>$request->experience,
            'vacancy'=>$request->vacancy,
            'description'=>$request->description,
            'responsibility'=>$request->responsibility,
            'benefit'=>$request->benefit,
        ]);

        foreach ($request->skill as $skillId) {
            $post->postSkill()->attach($skillId);
        }

        Session::flash('message','The post has successfully been added' );
        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $posts = JobPost::where('uuid',$uuid)
            ->with('recruiterProfile','jobType', 'postSkill')
            ->first();

            return view('recruiter.post.show', [
                'posts' => $posts,
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skills = Skill::get();
        $types = JobType::get();

        $post = JobPost::where('uuid',$id)
            ->with('postSkill','jobType')->first();
        $selectedSkills = $post->postSkill
            ->pluck('id')->toArray();

        return view('recruiter.post.update',[
            'post'=>$post,
            'skills'=>$skills,
            'types'=>$types,
            'selectedSkills' =>$selectedSkills,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPostRequest $request, string $id)
    {
        $request->validated();

        $uuid = JobPost::find($id);
        $post = JobPost::findOrFail($id);
        $post->update([
            'title'=>$request->title,
            'location'=>$request->location,
            'deadline'=>$request->deadline,
            'type_id'=>$request->type,
            'qualification'=>$request->qualification,
            'experience'=>$request->experience,
            'vacancy'=>$request->vacancy,
            'description'=>$request->description,
            'responsibility'=>$request->responsibility,
            'benefit'=>$request->benefit,
        ]);

        $post->postSkill()->detach();
        if ($request->has('skill')) {
            foreach ($request->input('skill') as $skillId) {
                $post->postSkill()->attach($skillId);
            }
        }

        return redirect()->route('jobs.show', $uuid->uuid);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = JobPost::where('deadline','<', now())->delete();
    }
}
