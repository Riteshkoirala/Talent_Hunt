<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPostRequest;
use App\Models\JobPost;
use App\Models\JobType;
use App\Models\RecruiterProfile;
use App\Models\skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $logUser = RecruiterProfile::where('user_id',Auth::user()->id)->first();

        if ($logUser) {
            $postData = JobPost::where('recruiter_id', $logUser->id)
                ->with('recruiterProfile','postSkill', 'jobType')
                ->latest('created_at')
                ->paginate(5);

            return view('recruiter.post.dashboard', [
                'posts' => $postData,
            ]);
        }
        return view('recruiter.profile.create');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
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
    public function store(JobPostRequest $request):RedirectResponse
    {

        $recruiterId = RecruiterProfile::where('user_id',Auth::User()->id)->first();

        $postData = $request->validated();
        $postData['uuid'] = Str::uuid();
        $postData['recruiter_id'] = $recruiterId->id;

        $post = JobPost::create($postData);
        $post->postSkill()->sync($request->skill);


        return redirect()->route('jobs.index')->with('message','The post has successfully been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): View
    {

        $posts = JobPost::where('uuid',$uuid)
            ->with('recruiterProfile','jobType', 'postSkill', 'application')
            ->first();

        if($posts) {
            return view('recruiter.post.show', [
                'posts' => $posts,
            ]);
        }
            return abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):View
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
    public function update(JobPostRequest $request, string $id):RedirectResponse
    {

        $post = JobPost::findOrFail($id);

        $postData = $request->validated();

        $post->update($postData);

        $post->postSkill()->sync($request->skill);

        return redirect()->route('jobs.show', $post->uuid)->with('message', 'The post has been successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = JobPost::where('deadline','<', now())->delete();
    }




}
