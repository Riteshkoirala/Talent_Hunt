@extends('components.base')

@section('content')
    <div class="contai">
        <div class="job_container">
            <h1>UPDATE RECRUITER PROFILE</h1><br>
            <form action="{{ route('profile.update',$profile->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <p>E-mail: </p> <input type="email" name="email" placeholder="email" value="{{ $profile->user->email }}"><br><br>
                <p>Company Name: </p><input type="text" name="company_name" placeholder="Buddha" value="{{ $profile->company_name }}"><br><br>
                <p>Location: </p> <input type="text" name="location" placeholder="company location" value="{{$profile->location}}"><br><br>
                <p>Contact_number: </p> <input type="text" name="contact_number" placeholder="number" value="{{ $profile->contact_number }}"><br><br>
                <p>Company Image</p><input type="file" name="image" value="{{ $profile->image }}"><br><br>
                <p>Company Detail: </p> <textarea name="detail" placeholder="Add the job perks and Benefits here">{{ $profile->detail }}</textarea><br><br>
                <button type="submit" name="submit">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
