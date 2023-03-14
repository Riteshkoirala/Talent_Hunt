@extends('components.base')

@section('content')
    <div class="contai">
        <div class="job_container">
            <h1>COMPLETE YOUR PROFILE</h1><br>
            <form action="{{ route('profiles.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="firstname">Firstname: </label>
                <input type="text" name="firstname" placeholder="john">
                @error('firstname') {{ $message }} @enderror
                <br><br>
                <label for="lastname">Lastname: </label>
                <input type="text" name="lastname" placeholder="doe">
                @error('lastname') {{ $message }} @enderror
                <br><br>
                <label for="location">Location: </label>
                <input type="text" name="location" placeholder="current location">
                @error('location') {{ $message }} @enderror
                <br><br>
                <label for="contact_number">Contact Number: </label>
                <input type="text" name="contact_number" placeholder="9812675211">
                @error('contact_number') {{ $message }} @enderror
                <br><br>
                <label for="skill[]">Skills that you have: </label>
                <div class="double">
                    @foreach($skills as $skill)
                        <input type="checkbox" name="skill[]" value="{{ $skill->id }}">
                        <label>{{ $skill->name }}</label>
                    @endforeach
                </div>
                <br>
                <label for="qualification">Highest Qualification: </label>
                <input type="text" name="qualification" placeholder="Qualification" >
                @error('qualification') {{ $message }} @enderror
                <br><br>
                <label for="college">College Name: </label>
                <input type="text" name="college" placeholder="college">
                @error('college') {{ $message }} @enderror
                <br><br>
                <label for="image">Current Image: </label>
                <input type="file" accept="image/*" name="image" >
                @error('image') {{ $message }} @enderror
                <br><br>
                <label for="cv">CV: </label>
                <input type="file" accept=".doc, .docx, .pdf" name="cv" >
                @error('cv') {{ $message }} @enderror
                <br><br>
                <label for="about">About Yourself: </label>
                <textarea name="about" placeholder="Add about you here"></textarea>
                @error('about') {{ $message }} @enderror
                <br><br>
                <label for="experience">Experience: </label>
                <textarea name="experience" placeholder="Add the job Experience here..."></textarea>
                @error('experience') {{ $message }} @enderror
                <br><br>
                <label for="description">Why do you want to Join us: </label>
                <textarea name="description" placeholder="Add reason here..."></textarea>
                @error('description') {{ $message }} @enderror
                <br><br>
                <button type="submit" name="submit">Profile Complete</button>
            </form>
        </div>
    </div>
@endsection
