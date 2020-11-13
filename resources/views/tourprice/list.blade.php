 @extends('layout._Layout')
@section('content')

<div class="page-header">
    <h3 class="page-title"> Tour Price </h3>
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
          <h4 class="card-title">List</h4>
          <p class="card-description"> <a href="/tourprice/addprc"> Create new </a> </p>
          <div class="form-group row">
            <div class="col-md-2 btn" >Tour</div>
            <div class="col-md-4">
            <select class="form-control" id="listtour" name="tour">
                <option selected >-None-</option>
                @foreach ($tour as $item)
                    <option id="tour_{{$item->tour_id}}" value="{{$item->tour_id}}">{{$item->tour_ten}}</option>
                @endforeach
            </select>
            </div>
            <div class="col-md-2">
                <input type="button" class="btn btn-gradient-success mr-2" id="btn-search" value="Search"/>
            </div>
            <div class="col-md-2">
                <input type="button" class="btn btn-gradient-warning mr-2" id="btn-newprice" value="New Price"/>
            </div>
          </div>
          <table class="table table-striped">
            @if (session('notice'))
                <div class="alert alert-danger">{{ session('notice') }}</div>
            @else
              <thead>
                <tr>
                  <th> id </th>
                  <th> Price </th>
                  <th> Day Start </th>
                  <th> Day End </th>
                </tr>
              </thead>
              <tbody id="table">

            </tbody>
            @endif
          </table>
        </div>
      </div>
    </div>
</div>

@endsection
@if (!session('notice'))
  @section('script')
  <script>
        $(document).ready(function(){
            $("#btn-search").click(function(){
                var id = $('#listtour').val();
                $.get("search&id="+id, function(data){
                    $("#table").html(data);
                });
            });
            $("#btn-newprice").click(function(){
                var id = $('#listtour').val();
                if(id!="-None-"){
                    location.replace("price&id="+id);
                }
            });
        });
    function del(id)
    {
      var a = confirm("Are you sure you want to DELETE this Tour Price");
      if(a){
        location.replace("delete&id="+id);
      }
    }
  </script>
  @endsection
@endif
{{session()->forget('notice')}}
