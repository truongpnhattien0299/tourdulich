@extends('layout._Layout')
@section('content')

<div class="page-header">
    <h3 class="page-title"> Count  </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
      </ol>
    </nav>
  </div>
  <div class="row">

    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <input type="date" class="form-control" id="start" name="start"  >
                </div>
                <div class="col">
                    <input type="date" class="form-control" id="end" name="end">
                </div>
                <div class="col">
                    <input type="button" class="btn btn-gradient-success mr-2" id="btn-search" value="Search"/>
                </div>
              </div>
          <h4 class="card-title">List</h4>
          <table class="table table-striped">
              <thead>
                <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Total </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($employee as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->count}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#btn-search").click(function(){
           var start = $('#start').val();
           var end = $('#end').val();
           if(start >= end){
                alert("The start day must be less than the end day");
           }else{
                $.get("search&start="+start+"&end="+end, function(data){
                    $('tbody').html(data);
                });
           }

        });

    });
</script>
@endsection
