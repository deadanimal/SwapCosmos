@extends('layouts.appx')

@section('content')
    <div class="row">

        <div class="col-12 col-xl-8">




            <table class="table table-striped table-sm buy-offers-datatable">
                <thead>
                    <tr>
                        <th scope="col">Price</th>
                        <th scope="col">Limit</th>
                        <th scope="col">User</th>
                        <th scope="col">Location</th>
                        <th scope="col">Method</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>



            <table class="table table-striped table-sm sell-offers-datatable">
                <thead>
                    <tr>
                        <th scope="col">Price</th>
                        <th scope="col">Limit</th>
                        <th scope="col">User</th>
                        <th scope="col">Location</th>
                        <th scope="col">Method</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>




        </div>
    </div>

    <script type="text/javascript">
        $(function() {

            var table = $('.buy-offers-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/offers?filter=buy",
                columns: [
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'limit',
                        name: 'limit'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'method',
                        name: 'method'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },


                ]
            });

            var table = $('.sell-offers-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/offers?filter=sell",
                columns: [{
                        data: 'DT_RowIndex',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        data: {
                            _: "created_at.display",
                            sort: "created_at.timestamp",
                            filter: 'created_at.display'
                        },
                        name: 'created_at.display'
                    },
                    {
                        data: 'DT_RowIndex',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        data: 'DT_RowIndex',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        data: 'DT_RowIndex',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        data: 'DT_RowIndex',
                        'orderable': false,
                        'searchable': false
                    },


                ]
            });


        });
    </script>
@endsection
