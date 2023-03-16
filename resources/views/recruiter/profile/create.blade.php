@extends('components.base')

@section('content')
    <div class="contai">
        <div class="job_container">
            <h1>COMPLETE THE RECRUITER PROFILE</h1><br>
            <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="company_name">Company Name: </label>
                <input type="text" name="company_name" placeholder="Buddha">
                @error('company_name')
                   {{ $message }}
                @enderror
                <br><br>
                <label for="location">Location: </label>
                <input type="text" name="location" placeholder="Lagankhel, kathmandu OR Lagenkhel-01, kathmandu">
                @error('location')
                   {{ $message }}
                @enderror
                <br><br>
                <label for="contact_number">Contact_number: </label>
                <input type="text" name="contact_number" placeholder="Qualification" >
                @error('contact_number')
                    {{ $message }}
                @enderror
                <br><br>
                <label for="image">Company Image</label>
                <input type="file" accept="image/*" name="image">
                @error('image')
                    {{ $message }}
                @enderror
                <br><br>
                <label for="detail">Company Detail: </label>
                <textarea name="detail" placeholder="Add the job perks and Benefits here"></textarea>
                @error('detail')
                    {{ $message }}
                @enderror
                <br><br>
                <button type="submit" name="submit">Complete Profile</button>
            </form>
        </div>
    </div>
@endsection
