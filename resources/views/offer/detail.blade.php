@extends('layouts.appx')

@section('content')
    <div class="row">
        <div class="col-12 col-xl-4">

            <div class="card mt-3">
                <div class="card-body">
                    <form action="/offers/{{ $offer->uid }}/message" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label mt-3">Message</label>
                            <textarea class="form-control" name="message" rows=5></textarea>
                        </div>                                   

                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary" type="submit">Send Message</button>
                        </div>                        
                    </form>

                    <form action="/offers/{{ $offer->uid }}/initiate" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label mt-3">Message</label>
                            <textarea class="form-control" name="message" rows=5></textarea>
                        </div>                                   

                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary" type="submit">Initiate</button>
                        </div>                        
                    </form>                    
    

                </div>
            </div>            

       



        </div>
        <div class="col-12 col-xl-8">

    

            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    <h2>Offer</h2>
                </div>
                <div class="card-body">
                    id": <br/>
uid": <br/>
trade_type": <br/>
min_payment": <br/>
max_payment": <br/>
coin_id": <br/>
payment_location_id": <br/>
payment_method_id": <br/>
payment_currency_id": <br/>
price_margin": <br/>
user_id": <br/>
terms": <br/>
headline": <br/>
created_at": <br/>
updated_at": <br/>
active": <br/>
                    

                </div>
            </div>


        </div>
    </div>

 
@endsection
