@extends('components.base')

@section('content')
    <div class="contai">
        <div class="job_container">
            <h1>COMPLETE YOUR PROFILE</h1><br>
            <form action="{{ route('profiles.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <p>Firstname: </p><input type="text" name="firstname" placeholder="john">@error('firstname') {{ $message }} @enderror<br><br>
                <p>Lastname: </p><input type="text" name="lastname" placeholder="doe">@error('lastname') {{ $message }} @enderror<br><br>
                <p>Location: </p> <input type="text" name="location" placeholder="current location">@error('location') {{ $message }} @enderror<br><br>
                <p>Contact Number: </p> <input type="text" name="contact_number" placeholder="9812675211">@error('contact_number') {{ $message }} @enderror<br><br>
                <p>Skills that you have: </p><div class="double">
                    @foreach($skills as $skill)
                        <input type="checkbox" name="skill[]" value="{{ $skill->id }}"><label>{{ $skill->name }}</label>
                    @endforeach
                </div><br>
                <p>Highest Qualification: </p> <input type="text" name="qualification" placeholder="Qualification" >@error('qualification') {{ $message }} @enderror<br><br>
                <p>College Name: </p> <input type="text" name="college" placeholder="college">@error('college') {{ $message }} @enderror<br><br>
                <p>Current Image: </p> <input type="file" name="image" >@error('image') {{ $message }} @enderror<br><br>
                <p>CV: </p> <input type="file" name="cv" >@error('cv') {{ $message }} @enderror<br><br>
                <p>About Yourself: </p> <textarea name="about" placeholder="Add about you here"></textarea>@error('about') {{ $message }} @enderror<br><br>
                <p>Experience: </p> <textarea name="experience" placeholder="Add the job Experience here..."></textarea>@error('experience') {{ $message }} @enderror<br><br>
                <p>Why do you want to Join us: </p> <textarea name="description" placeholder="Add the job Experience here..."></textarea>@error('description') {{ $message }} @enderror<br><br>

                <button type="submit" name="submit">Profile Complete</button>


            </form>
        </div>
    </div>
@endsection
