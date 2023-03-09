@extends('components.base')

@section('content')
    <div class="bodys">
        <div class="img">
            <div class="imgs">
                <img  class="imgs" src="{{asset('/images/seeker/'.$profile->image)}}">
            </div>
            <div class="profil">
                <h2>{{ $profile->firstname. " ". $profile->lastname }}</h2>
                <em>joined date: {{ $profile->created_at }}</em>
                <h4>{{ $profile->user->email }}</h4>
                <h4>{{ $profile->contact_number }}</h4>
                <h4>{{ $profile->location }}</h4>
            </div>

        </div>
        @if($profile->status == 0)
            <a class="status" href="#">Active</a>
        @else
            <a class="status" href="#">Inactive</a>
        @endif

        <div class="detail">
            <div class="skill">
            <h2>Skills:</h2>
                @foreach($profile->skill as $skills)
                    <p>{{ $skills->name }}</p>
                @endforeach
            </div>

        </div>
        <div class="detail">
           <h3> College Name: {{ $profile->college }}</h3>
            <br><h3>Education:</h3>
            <p>{{$profile->qualification}}</p>
        </div>
        <div class="detail">
            <h2>About Yourself:</h2>
            <p>{{ $profile->about }}</p>

        </div>
        <div class="detail">
            <h2>Experience:</h2>
            <p>{{ $profile->experience }}</p>

        </div>
        <div class="detail">
            <h2>Why Are You Searching For JOb:</h2>
            <p>Beacuse, I love it.</p>

        </div>
        <a href="/cv/{{ $profile->cv }}" download>download cv</a><tb>


        <a class="update" href="{{ route('profiles.edit', $profile->id) }}">Update Profile</a>

@endsection

