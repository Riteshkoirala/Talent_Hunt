@extends('components.base')

@section('content')
    <div class="contai">
    <div class="job_container">
        <h1>ADD NEW JOB POST</h1><br>
        <form action="{{ route('jobs.store') }}" method="post">
            @method('post')
            @csrf
            <p>Title: </p><input type="text" name="title" placeholder="job Title" value="{{ old('title') }}">            <p>@error('title') {{ $message }}@enderror</p>
            <br><br>
            <p>Location: </p> <input type="text" name="location" placeholder="company location" value="{{ old('location') }}">            <p>@error('location') {{ $message }}@enderror</p>
            <br><br>
            <p>Deadline: </p> <input type="datetime-local" name="deadline"  value="{{ old('deadline') }}">            <p>@error('deadline') {{ $message }}@enderror</p>
            <br><br>
            <p>Skills Required: </p><div class="double">
                    @foreach($skills as $skill)
                    <input type="checkbox" name="skill[]" value="{{ $skill->id }}"><label>{{ $skill->name }}</label>
                @endforeach
            </div>
            @error('skill')
            {{ $message }}
            @enderror
            <br>
            <p>Job Types: </p>
            <select class="type" name="type_id" >
                <option value="">Choose Job-Type</option>
            @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
            {{ $message }}
            @enderror<br><br>
            <p>Qualification: </p> <input type="text" name="qualification" placeholder="Qualification" >            <p>@error('qualification') {{ $message }}@enderror</p>
            <br><br>
            <p>Experience: </p> <input type="text" name="experience" placeholder="Experience">            <p>@error('experience') {{ $message }}@enderror</p>
            <br><br>
            <p>Vacancy: </p> <input type="number" name="vacancy" placeholder="Vancancy">            <p>@error('vacancy') {{ $message }}@enderror</p>
            <br><br>
           <p>Description: </p> <textarea name="description" placeholder="Add the job description here">  </textarea>          <p>@error('description') {{ $message }}@enderror</p>
<br><br>
            <p>Responsibility: </p> <textarea name="responsibility" placeholder="Add the job Responsibility here..."></textarea>            <p>@error('responsibility') {{ $message }}@enderror</p>
            <br><br>
            <p>Benefit: </p> <textarea name="benefit" placeholder="Add the job perks and Benefits here"></textarea>            <p>@error('benefit') {{ $message }}@enderror</p>
            <br><br>
            <button type="submit" name="submit">ADD JOB</button>


        </form>
    </div>
        </div>
@endsection
