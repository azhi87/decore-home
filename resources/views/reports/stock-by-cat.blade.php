@extends('layouts.master')
<link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" />
@section('content')
<div class="col-md-12">
    <div class="row bordered-2">

        <div class="col-md-12 col-sm-12 text-center color-black">
            <br />
            <p style="font-size: 48px; "><strong> ڕاپۆرتی کاتیگۆری : {{ $cat->name }} </strong></p>
        </div>
    </div>


    <div class="row table table-responsive">
        <table class="table table-responsive" id="myTable">
            <thead>
                <tr class="bg-info">
                    @foreach ($cat->subcategories as $subcat)
                    <th>{{ $subcat->name }}</th>
                    @endforeach
                </tr>

            </thead>
            <tbody>

                <tr>
                    @foreach ($cat->subcategories as $subcat)
                    <td> {{ $subcat->stock() }} </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>



    @endsection
    @section('afterFooter')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
		$('#myTable').DataTable( {
			"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
			"paging": false,//Dont want paging
			"bPaginate": false,//Dont want paging
            dom: 'Bfrtip',
            buttons: [
				'excel'
            ]
        });
    });
    </script>
    @endsection