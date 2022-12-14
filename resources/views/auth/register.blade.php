@extends('layouts.auth')

@section('content')

    <main class="form-signin">
        <form action="/register" method="POST">
            @csrf

            <input type="hidden" name="code" value="{{$code}}">

            <h1 class="h3 mb-3 fw-normal text-black">Swap Cosmos</h1>

            <div class="form-floating">
                <input type="text" name="code" value="{{$code}}" class="form-control" id="floatingInput" disabled>
                <label for="floatingInput">Code</label>
            </div>              

            <div class="form-floating mt-3">
                <input type="text" name="name" class="form-control" id="floatingInput">
                <label for="floatingInput">Name</label>
            </div>            

            <div class="form-floating mt-3">
                <input type="email" name="email" class="form-control" id="floatingInput">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mt-3">
                <input type="password" name="password" class="form-control" id="floatingPassword">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-floating mt-3">
                <input type="password" name="password_confirmation" class="form-control" id="floatingPassword">
                <label for="floatingPassword">Confirm Password</label>
            </div>            


            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>            
        </form>
        <p class="mt-5 mb-3 text-muted">&copy; 2022 Swap Cosmos Labs</p>
    </main>

@endsection
