@extends('components.base')

@section('content')
    <div class="contai">
        <div class="job_container">
            <h1>COMPLETE THE RECRUITER PROFILE</h1><br>
            <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <p>Company Name: </p><input type="text" name="company_name" placeholder="Buddha"><br><br>@error('company_name') {{ $message }} @enderror
                <p>Location: </p> <input type="text" name="location" placeholder="company location"><br><br>@error('location') {{ $message }} @enderror
                <p>Contact_number: </p> <input type="text" name="contact_number" placeholder="Qualification" ><br><br>@error('contact_number') {{ $message }} @enderror
                <p>Company Image</p><input type="file" name="image"><br><br>@error('image') {{ $message }} @enderror
                <p>Company Detail: </p> <textarea name="detail" placeholder="Add the job perks and Benefits here"></textarea><br><br>@error('detail') {{ $message }} @enderror
                <button type="submit" name="submit">Complete Profile</button>


            </form>
        </div>
    </div>
@endsection
