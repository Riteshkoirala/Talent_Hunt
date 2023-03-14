@extends('components.base')

@section('content')
    <div class="contai">
        <div class="job_container">
            <h1>UPDATE YOUTR PROFILE</h1><br>
            <form action="{{ route('profiles.update',$profile->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <label for="email">E-mail: </label>
                <input type="email" name="email" placeholder="email" value="{{ $profile->user->email }}">
                <br><br>
                <label for="firstname">Firstname: </label>
                <input type="text" name="firstname" placeholder="john" value="{{ $profile->firstname }}">
                @error('firstname') {{ $message }} @enderror
                <br><br>
                <label for="lastname">Lastname: </label>
                <input type="text" name="lastname" placeholder="doe" value="{{ $profile->lastname }}">
                @error('lastname') {{ $message }} @enderror
                <br><br>
                <label for="location">Location: </label>
                <input type="text" name="location" placeholder="current location" value="{{ $profile->location }}">
                @error('location') {{ $message }} @enderror
                <br><br>
                <label for="contact_number">Contact Number: </label>
                <input type="text" name="contact_number" placeholder="9812675211" value="{{ $profile->contact_number }}">
                @error('contact_number') {{ $message }} @enderror
                <br><br>
                <label for="status">Status: </label>
                <select name="status">
                    <option value="0">active</option>
                    <option value="1">Not Active</option>
                </select>
                <label for="skill[]">Skills Required: </label>
                <div class="double">
                    @foreach($skills as $skill)
                        <input type="checkbox" name="skill[]" value="{{ $skill->id }}"
                               @if(in_array($skill->id,$selectedSkills)) checked @endif>
                        <label>{{ $skill->name }}</label>
                    @endforeach
                </div>
                <br>
                <label for="qualification">Highest Qualification: </label>
                <input type="text" name="qualification" placeholder="Qualification" value="{{ $profile->qualification }}">
                @error('qualification') {{ $message }} @enderror
                <br><br>
                <label for="college">College Name: </label>
                <input type="text" name="college" placeholder="college" value="{{ $profile->college }}">
                @error('college') {{ $message }} @enderror
                <br><br>
                <label for="image">Current Image:</label>
                <input type="file" accept="image/*" name="image">
                @error('image') {{ $message }} @enderror
                <br><br>
                <label for="cv">CV: </label>
                <input type="file" accept=".doc, .docx, .pdf" name="cv" >
                @error('cv') {{ $message }} @enderror<br><br>
                <label for="about">About Yourself: </label>
                <textarea name="about" placeholder="Add about you here">
                    {{ $profile->about }}
                </textarea>
                @error('about') {{ $message }} @enderror
                <br><br>
                <label for="experience">Experience: </label>
                <textarea name="experience" placeholder="Add the job Experience here...">
                    {{ $profile->experience }}
                </textarea>
                @error('experience') {{ $message }} @enderror
                <br><br>
                <label for="description">Why do you want to Join us: </label>
                <textarea name="description" placeholder="Add the job Experience here...">
                    {{ $profile->description }}
                </textarea>
                @error('description') {{ $message }} @enderror<br><br>
                <button type="submit" name="submit">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
