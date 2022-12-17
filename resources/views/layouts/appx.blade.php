<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Swap Cosmos</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.2/cosmo/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
    @yield('styles')

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>
    @include('sweetalert::alert')
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Swap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">


                    @role('admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle show" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="true">Administration</a>
                            <div class="dropdown-menu hide" data-bs-popper="static">
                                <a class="dropdown-item" href="/admin/dashboard">Dashboard</a>
                                <a class="dropdown-item" href="/admin/users">Users</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/settings">Settings</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle show" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="true">Finance</a>
                            <div class="dropdown-menu hide" data-bs-popper="static">
                                <a class="dropdown-item" href="/admin/onramps">Deposits</a>
                                <a class="dropdown-item" href="/admin/adjustments">Adjustments</a>
                                <a class="dropdown-item" href="/admin/offramps">Withdrawals</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/rewards">Rewards</a>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle show" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="true">Core</a>
                            <div class="dropdown-menu hide" data-bs-popper="static">
                                <a class="dropdown-item" href="/admin/digits">Digit Games</a>
                                <a class="dropdown-item" href="/admin/powerballs">Powerballs</a>
                                <a class="dropdown-item" href="/admin/sportbets">Sport Bets</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/markets">Markets</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/offers">All Offer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/offers/create">Create Offer</a>
                        </li>
                    @endrole




                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </li> --}}
                </ul>
                {{-- <form class="d-flex">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form> --}}
                @if (Auth::user())

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="btn btn-primary dropdown-toggle show" data-bs-toggle="dropdown" href="#"
                                role="button" aria-haspopup="true" aria-expanded="true">
                                Blockchain Swap
                            </a>
                            <div class="dropdown-menu dropdown-menu-end hide" data-bs-popper="static">
                                {{-- <a class="dropdown-item" href="/play">Play Lottery</a> --}}
                                {{-- <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                <a class="dropdown-item" href="/trades">Trade</a>
                                <a class="dropdown-item" href="/notifications">Notification</a>
                                <div class="dropdown-divider"></div>
                                <form action='/logout' method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>


                @else
                    <a href="/dashboard">
                        <button class="btn btn-primary my-2 my-sm-0" type="button">Dashboard</button>
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <div class="container">
        <footer class="row py-3 my-3 border-top">


            <div class="col-sm-6 col-xl-3">
                <h5>Blockchain Swap</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="/offers?type=buy" class="nav-link p-0 text-muted">Buy Crypto from peer</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/offers?type=sell" class="nav-link p-0 text-muted">Sell Crypto to peer</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/contact-us" class="nav-link p-0 text-muted">Contact us</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/contact-us" class="nav-link p-0 text-muted">Ask for Help!</a>
                    </li>                    
                    {{-- <li class="nav-item mb-2">
                        <a href="/markets" class="nav-link p-0 text-muted">Bet on <b>Prediction</b></a>
                    </li> --}}
                </ul>
            </div>


            <div class="col-sm-6 col-xl-3">
                <h5>Help</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a
                            href="https://help.swapcosmos.com/support/solutions/articles/150000025572-how-to-deposit-money-into-your-swapcosmos-comccount"
                            class="nav-link p-0 text-muted">Common scams in cryptospace</a></li>
                    <li class="nav-item mb-2"><a
                            href="https://help.swapcosmos.com/en/support/solutions/articles/150000025573-how-to-withdraw-money-from-your-account"
                            class="nav-link p-0 text-muted">When to transfer money to seller?</a></li>
                    <li class="nav-item mb-2"><a href="https://help.swapcosmos.com/support/home"
                            class="nav-link p-0 text-muted">When to initiate a complain against buyer?</a></li>
                    <li class="nav-item mb-2"><a href="https://help.swapcosmos.com/support/home"
                            class="nav-link p-0 text-muted">How to complain against buyer?</a></li>
                </ul>
            </div>

            <div class="col-sm-6 col-xl-3">
                <h5>More Help</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a
                            href="https://help.swapcosmos.com/support/solutions/articles/150000025572-how-to-deposit-money-into-your-swapcosmos-comccount"
                            class="nav-link p-0 text-muted">How to transfer token out?</a></li>
                    <li class="nav-item mb-2"><a
                            href="https://help.swapcosmos.com/en/support/solutions/articles/150000025573-how-to-withdraw-money-from-your-account"
                            class="nav-link p-0 text-muted">How to receive token into wallet?</a></li>
                    <li class="nav-item mb-2"><a href="https://help.swapcosmos.com/support/home"
                            class="nav-link p-0 text-muted">How can I buy huge amount of crypto?</a></li>
                    <li class="nav-item mb-2"><a href="https://help.swapcosmos.com/support/home"
                            class="nav-link p-0 text-muted">What is Peer-to-Peer swap?</a></li>
                </ul>
            </div>

            <div class="col-sm-6 col-xl-3">
                <h5>web3</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a
                            href="https://help.swapcosmos.com/support/solutions/articles/150000025572-how-to-deposit-money-into-your-swapcosmos-comccount"
                            class="nav-link p-0 text-muted">What blockchain is this app run?</a></li>
                    <li class="nav-item mb-2"><a
                            href="https://help.swapcosmos.com/en/support/solutions/articles/150000025573-how-to-withdraw-money-from-your-account"
                            class="nav-link p-0 text-muted">Do you have a token sale?</a></li>
                    <li class="nav-item mb-2"><a href="https://help.swapcosmos.com/support/home"
                            class="nav-link p-0 text-muted">How can I stake on the blockchain?</a></li>
                    <li class="nav-item mb-2"><a href="https://help.swapcosmos.com/support/home"
                            class="nav-link p-0 text-muted">What is the gas fee?</a></li>
                </ul>
            </div>

        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    @yield('scripts')
</body>

</html>
