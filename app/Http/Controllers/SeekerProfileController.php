<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeekerRequest;
use App\Models\SeekerProfile;
use App\Models\skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    public function create()
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
    public function store(SeekerRequest $request)
    {
        $request->validated();
        $imageName= '';
        $cvname = '';
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/seeker'), $filename);
            $imageName= $filename;
        }
        if ($request->file('cv')) {
            $file = $request->file('cv');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('cv'), $filename);
            $cvname= $filename;
        }
        $seeker = SeekerProfile::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'user_id'=>Auth::user()->id,
            'location' => $request->location,
            'contact_number' => $request->contact_number,
            'qualification' => $request->qualification,
            'image'=>$imageName,
            'cv'=>$cvname,
            'college'=>$request->college,
            'about'=>$request->about,
            'description'=>$request->description,
            'experience'=>$request->experience,
        ]);
        foreach ($request->skill as $skillId) {
            $seeker->skill()->attach($skillId);
        }
        return redirect()->route('profiles.show',$seeker);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $profile = SeekerProfile::where('user_id', Auth::user()->id)->with('user')->with('skill')->first();
            return view('seeker.profile.show', [
                'profile' => $profile,
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function update(SeekerRequest $request, string $id)
    {
        $request->validateD();
        $imageName= '';
        $cvname = '';

        $proreq = SeekerProfile::where('id', $id)->find($id);
        $imageName = $proreq->image;
        $cvname = $proreq->cv;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/seeker'), $filename);
            $imageName= $filename;
        }
        if ($request->file('cv')) {
            $file = $request->file('cv');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('cv'), $filename);
            $cvname= $filename;
        }
        $seeker = SeekerProfile::findOrFail($id);
        $user = User::findOrFail(Auth::user()->id);

        $seeker->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'location' => $request->location,
            'contact_number' => $request->contact_number,
            'qualification' => $request->qualification,
            'image'=>$imageName,
            'cv'=>$cvname,
            'college'=>$request->college,
            'about'=>$request->about,
            'experience'=>$request->experience,
            'status'=>$request->status,
        ]);
        $user->update([
           'email'=>$request->email,
        ]);
        $seeker->skill()->detach();
        // Attach selected skills from request
        if ($request->has('skill')) {
            foreach ($request->input('skill') as $skillId) {
                $seeker->skill()->attach($skillId);
            }
        }
        return redirect()->route('profiles.show', $seeker);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkcv(){

    }
}
