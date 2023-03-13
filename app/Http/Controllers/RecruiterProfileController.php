<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecruiterRequest;
use App\Http\Services\FileCheck;
use App\Http\Services\LocationSeparator;
use App\Models\RecruiterProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RecruiterProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
    public function store(RecruiterRequest $request, FileCheck $fileCheck, LocationSeparator $locationSeparator): RedirectResponse
    {
        $imageName= '';

        if ($request->file('image')) {
            $imageName = $fileCheck->checkPhoto($request);
        }

        $location = $locationSeparator->LocationPurifier($request->location);

        $recruiterData = $request->validated();

        $recruiterData['user_id'] = Auth::user()->id;
        $recruiterData['location'] = $location;
        $recruiterData['image'] = $imageName;

        $recruiter = RecruiterProfile::query()->create($recruiterData);

        return redirect()->route('profile.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = RecruiterProfile::where('id',$id)->with('user')->first();
        return view('recruiter.profile.update',[
            'profile'=>$profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecruiterRequest $request, string $id, FileCheck $fileCheck, LocationSeparator $locationSeparator):RedirectResponse
    {
        $recruiterData = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = $fileCheck->checkPhoto($request);
            $recruiterData['image'] = $imageName;
        }

        $profile = RecruiterProfile::findOrFail($id);

        $location = $locationSeparator->LocationPurifier($request->location);

        $recruiterData['user_id'] = Auth::user()->id;
        $recruiterData['location'] = $location;
        $profile->update($recruiterData);

        $profile->user->update([
            'email'=>$request->email,
        ]);

        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
