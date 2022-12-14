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
                    <form action="/offers/create" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-3">Integer Value</label>
                            <input type="number" class="form-control" name="integerValue">
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-3">String Value</label>
                            <input type="text" class="form-control" name="stringValue">
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-lg btn-primary" type="submit">Add Setting</button>
                        </div>

                    </form>

                   

                </div>
            </div>


        </div>
    </div>

        
@endsection
