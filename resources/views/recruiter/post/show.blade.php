@extends('components.base')

@section('content')
    <div class="bodys">
        <div class="img">
            <div class="imgs">
                <img class="imgs" src="{{asset('/images/recruiter/'.$posts->recruiterProfile->image)}}">

            </div>
            <div class="profil">
                <h2>{{ $posts->title }}</h2>
                <em>posted on: {{ $posts->created_at }}</em>
                <h4>{{ $posts->recruiterProfile->email }}</h4>
                <h4>{{$posts->recruiterProfile->company_name}}</h4>
                <h4>{{$posts->location}}</h4>
                <em>Apply Before: {{ $posts->deadline }}</em>
                <h4>{{$posts->jobType->name}}</h4>
            </div>

        </div>
        <div class="detail">
            <div class="skill">
                <h2>Skills:</h2>
                @foreach($posts->postSkill as $skills)
                <p>{{ $skills->name }}</p>
                @endforeach
            </div>

        </div>
        <div class="detail">
            <h2>Job Description:</h2>
            <p>{{ $posts->description }}</p>

        </div>
        <div class="detail">
            <p>Qalification Required: {{$posts->qualification}}</p>
            <p>Experience Required: {{$posts->experience}}</p>
            <p>No. of Vacancy: [{{ $posts->vacancy }}]</p>

        </div>

        <div class="detail">
            <h2>Responsibility:</h2>
            <pre><p>{{$posts->responsibility}}</p></pre>

        </div>
        <div class="detail">
            <h2>Benefits and Perks:</h2>
            <pre><p>{{$posts->benefit}}</p></pre>

        </div>
        @if(Auth::user()->role =='recruiter')
        <a class="update" href="{{ route('jobs.edit',$posts->uuid) }}">Update Post</a>
    @elseif(Auth::user()->role=='seeker')
            @if(session('message')){{ session('message') }}
            @else
            <a class="update" href="{{ route('apply', $posts->uuid) }}">APPLY</a>
    @endif
    @endif
@endsection

