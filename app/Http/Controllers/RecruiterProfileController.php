<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecruiterRequest;
use App\Models\RecruiterProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RecruiterProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = RecruiterProfile::where('user_id', Auth::user()->id)->first();

            return view('recruiter.profile.show', [
                'profile' => $profile,
            ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecruiterRequest $request)
    {
        $request->validated();
        $imageName= '';
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/recruiter'), $filename);
            $imageName= $filename;
        }
        $recruiter = RecruiterProfile::create([
            'user_id' => Auth::user()->id,
            'company_name' => $request->company_name,
            'location' => $request->location,
            'contact_number' => $request->contact_number,
            'image' => $imageName,
            'detail' => $request->detail,
        ]);

        return redirect()->route('profile.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(RecruiterRequest $request, string $id)
    {
        $request->validated();

        $imageName= '';
        $recruiter = RecruiterProfile::where('id',$id)->first();
        $imageName = $recruiter->image;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/recruiter'), $filename);
            $imageName= $filename;
        }
        $profile = RecruiterProfile::findOrFail($id);
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
           'email'=>$request->email,
        ]);
        $profile->update([
            'company_name' => $request->company_name,
            'location' => $request->location,
            'contact_number' => $request->contact_number,
            'image' => $imageName,
            'detail' => $request->detail,
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
