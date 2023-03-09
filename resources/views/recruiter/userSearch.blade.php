@extends('components.base')

@section('content')
    <div class="sec">
        <div class="backdesign">
            <h4>You can find the jobs according to your interest.</h4>
        </div>
        <div class="secbody">
            <div class="filter">
                <form action="{{ route('user.search') }}" method="get">
                    <select name="location">
                        <option value=" ">Choose Location</option>
                        @foreach($seekers as $seeker)
                        <option value="{{ $seeker->location }}">{{ $seeker->location }}</option>
                        @endforeach
                    </select><br>
                    <select name="college">
                        <option value=" ">Choose college</option>
                    @foreach($seekers as $seeker)
                            <option value="{{ $seeker->college }}">{{ $seeker->college }}</option>
                        @endforeach                    </select><br>
                    <select name="skill">
                        <option value=" ">Choose skill</option>
                    @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach                    </select><br>
                    <input type="submit" name="submit" value="Filter">
                </form>
            </div>
            <div class="job">
                @foreach($users as $user)
                <div class="item">
                    <div class="pho">
                        <div class="phot">
                            <img class="phot" src="{{asset('/images/seeker/'.$user->image)}}" alt="Company Image">
                        </div>
                        <div class="cont">
                            <h2>{{ $user->firstname ." ". $user->lastname }}</h2>
                            <h5>{{ $user->location }}</h5>
                            <h5>{{ $user->college }}</h5>
                            <div class="change">
                                @foreach( $user->skill as $skill)
                                <h5>{{$skill->name}}</h5>
                                @endforeach
                            </div>
                            <a href="/cv/{{ $user->cv }}" download>download cv</a>
                        </div>
                    </div>
                </div>
                @endforeach
                    <div class="pagi">
                        {{ $users->links() }}
                    </div>            </div>

        </div>
    </div>
@endsection

