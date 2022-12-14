@extends('layouts.appx')

@section('content')
    <div class="px-4 pt-5 my-5 text-center">
        <h1 class="display-4 fw-bold">Swap Cosmos</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
                Convert your cash into crypto by trading with your friends. Participate in the revolution today!
            </p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                <a href="/howto"><button type="button" class="btn btn-success btn-lg px-4">How To Play?</button></a>
                <a href="/play"><button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Play Lottery Now!</button></a>                
            </div>
        </div>
        <div class="overflow-hidden" style="max-height: 50vh;">
            <div class="container px-5">
                <img src="/images/dice-3095227_1280.jpg" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image"
                    width="700" height="500" loading="lazy">
            </div>
        </div>
    </div>

    <div class="container px-4 py-5">
        <h2 class="pb-2 border-bottom">Game available</h2>

        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
            <div class="d-flex flex-column align-items-start gap-2">
                <h3 class="fw-bold">How to Market via Simping?</h3>
                <p class="text-muted">Paragraph of text beneath the heading to explain the heading. We'll add onto it with
                    another sentence and probably just keep going until we run out of words.</p>
                    <a href="/play"><button type="button" class="btn btn-primary btn-lg px-4">Play Lottery Now!</button></a>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 g-4">
                <div class="d-flex flex-column gap-2">
                    <h4 class="fw-semibold mb-0">Lowest Cost Per Engagement</h4>
                    <p class="text-muted">Paragraph of text beneath the heading to explain the heading.</p>
                </div>

                <div class="d-flex flex-column gap-2">
                    <h4 class="fw-semibold mb-0">Highest Returns On Spending</h4>
                    <p class="text-muted">Paragraph of text beneath the heading to explain the heading.</p>
                </div>

                <div class="d-flex flex-column gap-2">
                    <h4 class="fw-semibold mb-0">Access "Unreachable" Market</h4>
                    <p class="text-muted">Paragraph of text beneath the heading to explain the heading.</p>
                </div>

                <div class="d-flex flex-column gap-2">
                    <h4 class="fw-semibold mb-0">Systematic Influencer Marketing</h4>
                    <p class="text-muted">Paragraph of text beneath the heading to explain the heading.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <div class="wrapper">
                    <video autoplay muted loop class="myVideo">
                        <source src="/videos/3.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">Easy win to make money</h1>
                <p class="lead">Buy lottery tickets that are available 24/7 and at your fingertips. </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="/play"><button type="button" class="btn btn-primary btn-lg px-4">Play Lottery Now!</button></a>                    
                </div>
            </div>
        </div>
    </div>

    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <div class="wrapper">
                    <video autoplay muted loop class="myVideo">
                        <source src="/videos/3.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">Bet on your favourite team</h1>
                <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s
                    most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system,
                    extensive prebuilt components, and powerful JavaScript plugins.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="/play"><button type="button" class="btn btn-primary btn-lg px-4">Play Lottery Now!</button></a>
                </div>
            </div>
        </div>
    </div>     
@endsection
