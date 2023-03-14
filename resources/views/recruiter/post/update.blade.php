@extends('components.base')

@section('content')
    <div class="contai">
        <div class="job_container">
            <h1>UPDATE JOB POST</h1><br>
            <form action="{{ route('jobs.update', $post->id) }}" method="post">
                @method('put')
                @csrf
                <label for="title">Title: </label>
                <input type="text" name="title" placeholder="job Title" value="{{ $post->title }}">
                <p>
                    @error('title'){{ $message }}@enderror
                </p>
                <br><br>
                <label for="location">Location: </label>
                <input type="text" name="location" placeholder="company location" value="{{ $post->location }}">
                <p>
                    @error('location'){{ $message }}@enderror
                </p>
                <br><br>
                <label for="deadline">Deadline: </label>
                <input type="datetime-local" name="deadline" value="{{ $post->deadline }}">
                <p>
                    @error('deadline') {{ $message }}@enderror
                </p>
                <br><br>
                <label for="skill[]">Skills Required: </label>
                <div class="double">
                    @foreach($skills as $skill)
                        <input type="checkbox" name="skill[]" value="{{ $skill->id }}"
                               @if(in_array($skill->id,$selectedSkills))
                                   checked
                            @endif>
                        <label>
                            {{ $skill->name }}
                        </label>
                    @endforeach
                </div>
                <br>
                <label for="type_id">Job Types: </label>
                <select class="type" name="type_id">
                    <option value="{{ $post->type_id }}">{{ $post->jobType->name }}</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                <br><br>
                <label for="qualification">Qualification: </label>
                <input type="text" name="qualification" placeholder="Qualification" value="{{ $post->qualification }}">
                <p>
                    @error('qualification'){{ $message }}@enderror
                </p>
                <br><br>
                <label for="experience">Experience: </label>
                <input type="text" name="experience" placeholder="Experience" value="{{ $post->experience }}">
                <p>
                    @error('experience'){{ $message }}@enderror
                </p>
                <br><br>
                <label for="vacancy">Vacancy: </label>
                <input type="number" name="vacancy" placeholder="Vancancy" value="{{ $post->vacancy }}">
                <p>
                    @error('vacancy'){{ $message }}@enderror
                </p>
                <br><br>
                <label for="description">Description: </label>
                <textarea name="description" placeholder="Add the job description here">
                    {{ $post->description }}
                </textarea>
                <p>
                    @error('description'){{ $message }}@enderror
                </p>
                <br><br>
                <label for="responsibility">Responsibility: </label>
                <textarea name="responsibility" placeholder="Add the job Responsibility here...">
                    {{ $post->responsibility }}
                </textarea>
                <p>
                    @error('responsibility'){{ $message }}@enderror
                </p>
                <br><br>
                <label for="benefit">Benefit: </label>
                <textarea name="benefit" placeholder="Add the job perks and Benefits here">
                    {{ $post->benefit }}
                </textarea>
                <p>
                    @error('benefit'){{ $message }}@enderror
                </p>
                <br><br>
                <button type="submit" name="submit">UPDATE JOB</button>
            </form>
        </div>
    </div>
@endsection
