 @extends('layout._Layout')
@section('content')

<div class="page-header">
    <h3 class="page-title"> Group </h3>
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
          <p class="card-description"> <a href="/Group/addgrp"> Create new </a> </p>
          <table class="table table-striped">
            @if (session('notice'))
                <div class="alert alert-danger">{{ session('notice') }}</div>
            @else
              <thead>
                <tr>
                  <th> id </th>
                  <th> Name </th>
                  <th> Tour </th>
                  <th> Start </th>
                  <th> End </th>
                  <th> Details </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($group as $item)

                <tr>
                  <td> {{$item->doan_id}} </td>
                  <td> {{$item->doan_name}} </td>
                  <td> {{$item->tour->tour_ten}} </td>
                  <td> {{$item->doan_ngaydi}} </td>
                  <td> {{$item->doan_ngayve}} </td>
                  <td> {{$item->doan_chitietchuongtrinh}} </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" style="padding: 10%">Select</button>
                      <div class="dropdown-menu" style="min-width: 10px">
                        <a href="{{asset('editgrp')}}&id={{$item->doan_id}}" class="dropdown-item">Edit</a>
                        <a class="dropdown-item" onclick="get({{$item->doan_id}})" >Details</a>
                        <a onclick="del()" id="del" class="dropdown-item" style="cursor: pointer">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>

                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

@endsection
@if (!session('notice'))
  @section('script')
  <script>
    function get(id){
        window.location="cost/addcp&id="+id;
    }
    function del()
    {
      var a = confirm("Are you sure you want to DELETE this Group");
      if(a)
        location.replace("{{asset('group/delete')}}&id={{$item->doan_id}}");
    }
  </script>
  @endsection
@endif
{{session()->forget('notice')}}
