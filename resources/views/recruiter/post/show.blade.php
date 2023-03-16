@extends('components.base')

@section('content')
    <div class="bodys">
        @if(Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif
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
            <a href="{{ route('application.show', $posts->uuid) }}">Applicant</a>
        @elseif(Auth::user()->role=='seeker')
            @forelse($posts->application as $applied)
                @if($applied->post_id == $posts->id && $applied->seekerProfile->user_id == Auth::user()->id)
                    You have already applied for this job
                @endif
            @empty
                <a class="update" id="apply" href="{{ route('apply',$posts->uuid) }}" onclick="return ruleApply()" data-id="{{ $posts->uuid }}">APPLY</a>
            @endforelse
        @endif
    </div>
@endsection
<script>
    function ruleApply(){
        return confirm('Do you sure to apply for this job {{ $posts->title }}?');
    }

    {{--function clickFunc() {--}}
    {{--    let applyBtn = document.getElementById('apply');--}}
    {{--    let postId = applyBtn.getAttribute('data-id');--}}
    {{--    let text = "Press a button!\nEither OK or Cancel.";--}}
    {{--    if (confirm(text) == true) {--}}
    {{--        let link = '{{ route('apply', ':id') }}';--}}
    {{--        link = link.replace(':id', postId);--}}
    {{--        apply.setAttribute("href", link);--}}
    {{--    }--}}
    {{--}--}}

</script>

