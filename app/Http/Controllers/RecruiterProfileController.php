<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecruiterRequest;
use App\Http\Services\FileCheck;
use App\Models\RecruiterProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RecruiterProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $profile = RecruiterProfile::where('user_id', Auth::user()->id)->first();

        if(!$profile){
            return view('recruiter.profile.create');
        }
            return view('recruiter.profile.show', [
                'profile' => $profile,
            ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecruiterRequest $request, FileCheck $fileCheck): RedirectResponse
    {
        $imageName= '';

        if ($request->file('image')) {
            $imageName = $fileCheck->checkPhoto($request);
        }

        $recruiterData = $request->validated();

        $recruiterData['user_id'] = Auth::user()->id;
        $recruiterData['image'] = $imageName;

        $recruiter = RecruiterProfile::query()->create($recruiterData);

        return redirect()->route('profile.index')->with('message','The profile has been Completed...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $profile = RecruiterProfile::where('id',Auth::user()->id)->with('user')->first();
        return view('recruiter.profile.update',[
            'profile'=>$profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecruiterRequest $request, string $id, FileCheck $fileCheck):RedirectResponse
    {
        $recruiterData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = $fileCheck->checkPhoto($request);
            $recruiterData['image'] = $imageName;
        }

        $profile = RecruiterProfile::findOrFail($id);


        $recruiterData['user_id'] = Auth::user()->id;
        $profile->update($recruiterData);

        $profile->user->update([
            'email'=>$request->email,
        ]);

        return redirect()->route('profile.index')->with('message','The profile has been Updated...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
