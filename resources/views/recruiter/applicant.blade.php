@extends('components.base')

@section('content')
    <div class="sec">
        <div class="backdesign">
            <h4>The Applicant who have applied for this job.. </h4>
        </div>
        @foreach( $applications as $applicant)
        <div class="secbody">
            <div class="job">
                <div class="item">
                    <div class="pho">
                        <div class="phot">
                            <img class="phot" src="{{asset('/images/seeker/'.$applicant->SeekerProfile->image)}}">
                        </div>
                        <div class="cont">
                            <h2>{{ $applicant->seekerProfile->firstname." ". $applicant->seekerProfile->lastname}}</h2>
                            <h4>{{$applicant->jobPost->jobType->name}}</h4>
                            <div class="change">
                                <p>Has applied For: {{ $applicant->jobPost->title }}</p>
                            </div>
                            <em>Job Posted on: {{ $applicant->jobPost->created_at }}</em><br>
                            <em>Applied date: {{ $applicant->created_at }}</em>
                        </div>
                    </div>
                    <div class="btn">
                        <a href="/cv/{{ $applicant->seekerProfile->cv }}" download>download cv</a>
                        @if($applicant->status == 'applied')
                            <a class="sel" href="{{ route('selected', $applicant->id) }}" onclick=" return action()">Select</a>
                        @else
                            <form action="{{ route('selected', $applicant->id) }}" method="get">
                                @method('put')
                                <input type="text" name="link"><button type="submit">Add Exam Link</button>
                            </form>
                        @endif
                        <a class="del" href="{{ route('application.edit', $applicant->id) }}" onclick=" return action()" >Reject</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
<script>
    function action(){
        return confirm('Are you sure you want to perform this action?');
    }
</script>

