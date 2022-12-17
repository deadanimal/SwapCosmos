@extends('layouts.appx')

@section('content')
    <div class="row">
        <div class="col-xl-2">    



        </div>
        <div class="col-12 col-xl-8">

    

            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    <h3>Create Offer</h3>
                </div>
                <div class="card-body">
                    <form action="/offers" method="POST">
                        @csrf

                        <input type="hidden" value="{{ Auth::user()->id }}">


                        {{-- 
                        'trade_type' => $request->trade_type,
                         --}}

                        <div class="form-group">
                            <label class="form-label">Trade Type</label>
                            <select class="form-select" name="trade_type">
                                <option value="buy" selected>Buy</option>
                                <option value="sell">Sell</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-3">Min Payment</label>
                            <input type="number" class="form-control" name="min_payment">
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-3">Max Payment</label>
                            <input type="number" class="form-control" name="max_payment">
                        </div>                      

                        <div class="form-group">
                            <label class="form-label mt-3">Price Margin</label>
                            <input type="number" class="form-control" name="price_margin">
                        </div> 

                        <div class="form-group">
                            <label class="form-label mt-3">Headline</label>
                            <input type="text" class="form-control" name="headline">
                        </div>     
                        
                        <div class="form-group">
                            <label class="form-label mt-3">Terms</label>
                            <textarea class="form-control" name="terms" rows=5></textarea>
                        </div>                                   

                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary" type="submit">Create Offer</button>
                        </div>

                    </form>

                   

                </div>
            </div>


        </div>
    </div>

        
@endsection
