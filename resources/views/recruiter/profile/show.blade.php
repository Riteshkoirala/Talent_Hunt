@extends('components.base')

@section('content')
    <div class="bodys">
        @if(Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif
        <div class="img">
            <div class="imgs">
                <img class="imgs" src="{{asset('/images/recruiter/'.$profile->image)}}" alt="Company Image">
            </div>
            <div class="profil">
                <h2>{{ $profile->company_name }}</h2>
                <em>joined date: {{ $profile->created_at }}</em>
                <h4>{{$profile->user->email}}</h4>
                <h4>{{ $profile->contact_number }}</h4>
                <h4>{{$profile->location}}</h4>
            </div>
        </div>
        <div class="detail">
            <h2>Company description:</h2>
            <p>{{ $profile->detail }}</p>
        </div>
    </div>
        <a class="update" href="{{ route('profile.edit', 'updatingUser') }}">Update Profile</a>
@endsection

