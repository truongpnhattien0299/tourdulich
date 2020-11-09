@extends('layout._Layout')
@section('content')
    
<div class="page-header">
    <h3 class="page-title"> Category Tour </h3>
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
          <p class="card-description"> <a href="/category/addcate"> Create new </a> </p>
          <table class="table table-striped">
            @if (session('notice'))
                <div class="alert alert-danger">{{ session('notice') }}</div>
            @else
              <thead>
                <tr>
                  <th> id </th>
                  <th> Name </th>
                  <th> Category </th>
                  <th> Description </th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($tour as $item)
                  <tr>
                      <td> {{$item->tour_id}} </td>
                      <td> {{$item->tour_ten}} </td>
                      <td> {{$item->loaitour->loai_ten}} </td>
                      <td> {{$item->tour_mota}} </td>
                      <td>  
                      <div class="btn-group">
                          <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" style="padding: 10%">Select</button>
                          <div class="dropdown-menu" style="min-width: 10px">
                          <a href="editcate&id={{$item->loai_id}}" class="dropdown-item">Edit</a>
                          <a onclick="del()" id="del" class="dropdown-item" style="cursor: pointer">Delete</a>
                          </div>
                      </div>
                      </td>
                  </tr>
                  @endforeach
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
    function del()
    {
      var a = confirm("Are you sure you want to DELETE this category");
      if(a)
        location.replace("delete&id={{$item->loai_id}}");
    }
  </script>
  @endsection
@endif
{{session()->forget('notice')}}