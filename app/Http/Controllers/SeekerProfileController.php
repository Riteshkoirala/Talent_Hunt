<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeekerRequest;
use App\Http\Services\FileCheck;
use App\Http\Services\LocationSeparator;
use App\Models\SeekerProfile;
use App\Models\skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SeekerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $skills = skill::get();
        return view('seeker.profile.create',
        [
            'skills' => $skills,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeekerRequest $request, FileCheck $fileCheck, LocationSeparator $locationSeparator): RedirectResponse
    {

        $seekerData = $request->validated();

        if ($request->file('cv')) {
            $cvName = $fileCheck->checkCv($request);
            $seekerData['cv'] = $cvName;
        }
        if ($request->file('image')) {
            $imageName = $fileCheck->checkPhoto($request);
            $seekerData['image'] = $imageName;
        }

        $location = $locationSeparator->LocationPurifier($request->location);
        $seekerData['user_id'] = Auth::user()->id;
        $seekerData['location'] = $location;

        $seeker = SeekerProfile::query()->create($seekerData);

        $seeker->skill()->sync($request->skill);

        return redirect()->route('profiles.show', $seeker);
    }


    /**
     * Display the specified resource.
     */
    public function show():View
    {

        $profile = SeekerProfile::where('user_id', Auth::user()->id)->with('user')->with('skill')->first();

        if (!$profile){
            $skills = skill::get();
            return view('seeker.profile.create',[
                'skills'=>$skills,
            ]);
        }

        return view('seeker.profile.show', [
            'profile' => $profile,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $skills = Skill::get();
        $profile = SeekerProfile::where('id',$id)->with('user')->first();
        $selectedSkills = $profile->skill->pluck('id')->toArray();

        return view('seeker.profile.update',[
            'profile'=>$profile,
            'skills'=>$skills,
            'selectedSkills'=>$selectedSkills,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeekerRequest $request, string $id, FileCheck $fileCheck, LocationSeparator $locationSeparator):RedirectResponse
    {

        $seeker = SeekerProfile::findOrFail($id);
        $seekerData = $request->validated();

        if ($request->hasFile('cv')) {
            $cvName = $fileCheck->checkCv($request);
            $seekerData['cv'] = $cvName;
        }
        if ($request->hasFile('image')) {
            $imageName = $fileCheck->checkPhoto($request);
            $seekerData['image'] = $imageName;
        }

        $location = $locationSeparator->LocationPurifier($request->location);
        $seekerData['location'] = $location;
        $seeker->update($seekerData);

        $seeker->user->update([
           'email'=>$request->email,
        ]);

        $seeker->skill()->sync($request->input('skill', []));
        return redirect()->route('profiles.show', $seeker);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
