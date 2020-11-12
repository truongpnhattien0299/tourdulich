 @extends('layout._Layout')
@section('content')

<div class="page-header">
    <h3 class="page-title"> List Group </h3>
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
          <p class="card-description"> <a href="/Listgroup/addlgrp"> Create new </a> </p>
          <table class="table table-striped">
            @if (session('notice'))
                <div class="alert alert-danger">{{ session('notice') }}</div>
            @else
              <thead>
                <tr>
                  <th> id </th>
                  <th> Group </th>
                  <th> List Customer </th>
                  <th> List Employee </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($listgroup as $item)

                <tr>
                  <td> {{$item->nguoidi_id}} </td>
                  <td> {{$item->doan_id}} </td>
                  <td> {{$item->nguoidi_dsnhanvien}} </td>
                  <td> {{$item->nguoidi_dskhach}} </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" style="padding: 10%">Select</button>
                      <div class="dropdown-menu" style="min-width: 10px">
                        <a href="editlgrp&id={{$item->nguoidi_id}}" class="dropdown-item">Edit</a>
                        <a onclick="del()" id="del" class="dropdown-item">Delete</a>
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
    function del()
    {
      var a = confirm("Are you sure you want to DELETE this List Group");
      if(a)
        location.replace("delete&id={{$item->nguoidi_id}}");
    }
  </script>
  @endsection
@endif
{{session()->forget('notice')}}
