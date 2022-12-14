@extends('layouts.auth')

@section('content')

    <main class="form-signin">
        <form action="/login" method="POST">
            @csrf
            {{-- <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72"
                height="57"> --}}
            <h1 class="h3 mb-3 fw-normal text-black">Swap Cosmos</h1>

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mt-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>


            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>            
        </form>
        <p class="mt-5 mb-3 text-muted">&copy; 2022 Swap Cosmos Labs</p>
    </main>

@endsection
