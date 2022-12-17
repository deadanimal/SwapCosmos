@extends('layouts.appx')

@section('content')
    <div class="row">
        <div class="col-12 col-xl-4">

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6>Promotional Code</h6>
                            <h1>1</h1>                            
                        </div>
                        <div class="col-6">
                            <h6>No. of Downline(s)</h6>
                            <h1>-</h1>                            
                        </div>
                    </div>
                </div>
            </div>            

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6>Lifetime Reward, USD</h6>
                            <h1>-</h1>                            
                        </div>
                        <div class="col-6">
                            <h6>Weekly Reward, USD</h6>
                            <h1>-</h1>                            
                        </div>
                    </div>
                </div>
            </div>         



        </div>
        <div class="col-12 col-xl-8">

    

            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    <h6>Reward</h6>
                </div>
                <div class="card-body">


                    <table class="table table-striped table-sm rewards-datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                      

                </div>
            </div>


        </div>
    </div>

    <script type="text/javascript">
        $(function() {

            var table = $('.rewards-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/rewards",
                columns: [
                    { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                    {
                        data: {
                            _: "created_at.display",
                            sort: "created_at.timestamp",
                            filter: 'created_at.display'
                        },
                        name: 'created_at.display'
                    },                    
                    {
                        data: 'amount_',
                        name: 'amount_'
                    },	                                        
    			
  

                ]
            });


        });
    </script>        
@endsection
