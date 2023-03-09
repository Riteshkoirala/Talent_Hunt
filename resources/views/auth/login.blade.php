@extends('components.base')

@section('content')

    <div class="image">
        <div class="text">
            <div class="log">
                <h2>SIGN IN</h2>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <input type="email" name="email" placeholder="johndoe@gmail.com">
                    @error('email')
                    <span><p> {{ $message }}</p></span>
                    @enderror                <input type="password" name="password" placeholder="Password">
                    @error('password')
                    <span><p> {{ $message }}</p></span>
                    @enderror                <a href="{{ route('password.request') }}">Forget Password? Click here.</a>
                    <input type="submit" name="submit" value="LOGIN">
                    <a href="{{ route('register') }}">Dont have an account? Create one.</a>
                    <p class="tex">OR SIGN IN WITH</p>
                    <h1><a class="goo" href="{{ route('signIn') }}">G</a></h1>


                </form>

            </div>
        </div>
    </div>
@endsection

