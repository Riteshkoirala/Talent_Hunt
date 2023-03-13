@extends('components.base')

@section('content')

    <div class="image">
        <div class="text">
            <div class="logs">
                <h3>What are you looking into.</h3>
                @isset($message)
                    {{ $message }}
                @endisset
                <form action="{{ route('signUp') }}" method="get">
                    @csrf

                    <select name="role">
                        <option value="">select the role</option>
                        <option value="seeker">Job Seeker</option>
                        <option value="recruiter">Recruiter</option>
                    </select>@error('role')
                    <span><p>{{ $message }}</p></span>
                    @enderror
                    <input type="submit" name="submit" value="SIGNUP">
                </form>

            </div>
        </div>
    </div>

@endsection

