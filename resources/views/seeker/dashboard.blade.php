@extends('components.base')

@section('content')
    <div class="sec">
        <div class="backdesign">
            <h4>You can find the jobs according to your interest.</h4>
    </div>
        <div class="secbody">
    <div class="filter">
        <form action="{{ route('dashboard') }}" method="get">
            <select name="location">
                <option value=" ">Choose Location</option>
                @foreach($location as $loca)
                    <option value="{{ $loca->location }}">{{ $loca->location }} </option>
                @endforeach
            </select><br>
            <select name="company">
                <option value=" "> Choose Company</option>
                @foreach($company as $comp)
                    <option value="{{ $comp->company_name }} ">{{ $comp->company_name }} </option>
                @endforeach
            </select><br>
            <select name="type">
                <option value=" ">Choose Job Type</option>
                @foreach($type as $typ)
                    <option value="{{ $typ->id }}">{{ $typ->name }} </option>
                @endforeach
            </select><br>
            <select name="skill">
                <option value=" ">Choose Skills</option>
                @foreach($skill as $skl)
                    <option value="{{ $skl->id }} ">{{ $skl->name }} </option>
                @endforeach

            </select><br>
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
            <div class="job">
                @foreach($posts as $post)

                <div class="item">

                <div class="pho">
                    <div class="photo">
                        <img class="photo" src="{{asset('/images/recruiter/'.$post->recruiterProfile->image)}}">
                    </div>
                    <div class="cont">
                        <h2>{{$post->title}}</h2>
                        <h4>{{ $post->jobType->name }}</h4>
                        <h5>{{$post->location}}</h5>
                        <div class="change">
                            @foreach( $post->postSkill as $skill)
                                <h5>{{ $skill->name }}</h5>
                            @endforeach
                        </div>
                        <h5>{{ $post->recruiterProfile->company_name }}</h5>
                        <em>Apply before: {{ $post->deadline }}</em>

                    </div>
                </div>
                <a href="{{ route('display', $post->uuid) }}">Apply</a>
            </div>
                @endforeach

        </div>

        </div>

    </div>

@endsection

