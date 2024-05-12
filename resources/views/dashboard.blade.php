@extends('layouts.user_type.auth')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</div>
  <div class="row mt-4">
      <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card" style="background-image: linear-gradient(310deg,aqua,blue)">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-lg-12">
                <div class="d-flex flex-column h-100">
                  <center>
                    <h2 class="font-weight-bolder" style="color: white">Selamat Datang di Dashboard</h2>
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  
@endsection
@push('dashboard')




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script>
$(document).ready(function () {
        $('#myDataTable').DataTable();
        $('#myDataTable2').DataTable();
        $('#myDataTable3').DataTable();
    });

$("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
  </script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

@endpush

