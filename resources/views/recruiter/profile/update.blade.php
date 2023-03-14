@extends('components.base')

@section('content')
    <div class="contai">
        <div class="job_container">
            <h1>UPDATE RECRUITER PROFILE</h1><br>
            <form action="{{ route('profile.update',$profile->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <label for="email">E-mail: </label>
                <input type="email" name="email" placeholder="email" value="{{ $profile->user->email }}">
                <br><br>
                <label for="company_name">Company Name: </label>
                <input type="text" name="company_name" placeholder="Buddha" value="{{ $profile->company_name }}">
                <br><br>
                <label for="location">Location: </label>
                <input type="text" name="location" placeholder="company location" value="{{$profile->location}}">
                @error('location')
                  {{ $message }}
                @enderror
                <br><br>
                <label for="contact_number">Contact_number: </label>
                <input type="text" name="contact_number" placeholder="number" value="{{ $profile->contact_number }}">
                @error('contact_number')
                   {{ $message }}
                @enderror
                <br><br>
                <label for="image">Company Image</label>
                <input type="file" accept="image/*" name="image" value="{{ $profile->image }}">
                @error('image')
                   {{ $message }}
                @enderror
                <br><br>
                <label for="detail">Company Detail: </label>
                <textarea name="detail" placeholder="Add the job perks and Benefits here">
                    {{ $profile->detail }}
                </textarea>
                <br><br>
                <button type="submit" name="submit">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
