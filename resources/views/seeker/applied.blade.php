@extends('components.base')

@section('content')
    <div class="sec">
        <div class="backdesign">
            <h4>The job that you have applied for.</h4>
        </div>
        @foreach( $applications as $applicant)
            <div class="secbody">
                <div class="job">
                    <div class="item">
                        <div class="pho">
                            <div class="photo">
                                <img class="photo" src="{{asset('/images/recruiter/'.$applicant->jobPost->recruiterProfile->image)}}">
                            </div>
                            <div class="cont">
                                <h2>{{ $applicant->jobPost->title }}</h2>
                                <h4>{{ $applicant->jobPost->jobType->name }}</h4>
                                <div class="change">
                                    <h6>{{ $applicant->jobPost->location }}</h6>
                                    @foreach($applicant->jobPost->postSkill as $skill )
                                        <h5>{{ $skill->name }}</h5>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if($applicant->link == "wait")
                            <p>If you are selected your Exam link appear here</p>
                        @else
                            <a class="disgo" href="{{ $applicant->link}}" target="_blank" >Take Exam</a>
                        @endif
                        <a href="{{ route('display', $applicant->jobPost->uuid) }}">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

