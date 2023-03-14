@extends('components.base')

@section('content')
    <div class="sec">
        <div class="backdesign">
            <h4>The job that you have posted.</h4>
        </div>
        @if(Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif
        @foreach( $posts as $post)
            <div class="secbody">
                <div class="job">
                    <div class="item">
                        <div class="pho">
                            <div class="photo">
                                <img class="photo" src="{{asset('/images/recruiter/'.$post->recruiterProfile->image)}}" alt="Company image">
                            </div>
                            <div class="cont">
                                <h2>{{ $post->title }}</h2>
                                <h4>{{ $post->jobType->name }}</h4>
                                <div class="change">
                                    <h6>{{$post->location}}</h6>
                                    @foreach($post->postSkill as $skill )
                                        <h5>{{ $skill->name }}</h5>
                                    @endforeach
                                </div>
                                <h4>{{ $status }}</h4>
                                <h5>{{ $post->recruiterProfile->company_name }}</h5>
                                <h5>Apply before:{{ $post->deadline }}</h5>
                            </div>
                        </div>
                        <a href="{{ route('jobs.show', $post->uuid ) }}">View</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagi">
            {{ $posts->links() }}
        </div>
    </div>
@endsection


