@extends('components.base')

@section('content')
    <div class="contai">
        <div class="job_container">
            <h1>UPDATE RECRUITER PROFILE</h1><br>
            <form action="{{ route('profiles.update',$profile->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <p>E-mail: </p> <input type="email" name="email" placeholder="email" value="{{ $profile->user->email }}"><br><br>
                <p>Firstname: </p><input type="text" name="firstname" placeholder="john" value="{{ $profile->firstname }}">@error('firstname') {{ $message }} @enderror<br><br>
                <p>Lastname: </p><input type="text" name="lastname" placeholder="doe" value="{{ $profile->lastname }}">@error('lastname') {{ $message }} @enderror<br><br>
                <p>Location: </p> <input type="text" name="location" placeholder="current location" value="{{ $profile->location }}">@error('location') {{ $message }} @enderror<br><br>
                <p>Contact Number: </p> <input type="text" name="contact_number" placeholder="9812675211" value="{{ $profile->contact_number }}">@error('contact_number') {{ $message }} @enderror<br><br>
                <select name="status">
                    <option value="0">active</option>
                    <option value="1">Not Active</option>
                </select>
                <p>Skills Required: </p><div class="double">
                    @foreach($skills as $skill)
                        <input type="checkbox" name="skill[]" value="{{ $skill->id }}"  @if(in_array($skill->id,$selectedSkills)) checked @endif><label>{{ $skill->name }}</label>
                    @endforeach
                </div><br>
                <p>Highest Qualification: </p> <input type="text" name="qualification" placeholder="Qualification" value="{{ $profile->qualification }}">@error('qualification') {{ $message }} @enderror<br><br>
                <p>College Name: </p> <input type="text" name="college" placeholder="college" value="{{ $profile->college }}">@error('college') {{ $message }} @enderror<br><br>
                <p>Current Image: </p> <input type="file" name="image" >@error('image') {{ $message }} @enderror<br><br>
                <p>CV: </p> <input type="file" name="cv" >@error('cv') {{ $message }} @enderror<br><br>
                <p>About Yourself: </p> <textarea name="about" placeholder="Add about you here">{{ $profile->about }}</textarea>@error('about') {{ $message }} @enderror<br><br>
                <p>Experience: </p> <textarea name="experience" placeholder="Add the job Experience here...">{{ $profile->experience }}</textarea>@error('experience') {{ $message }} @enderror<br><br>
                <button type="submit" name="submit">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
