@extends('layout._Layout')
@section('content')
    
<div class="page-header">
    <h3 class="page-title"> Customer </h3>
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
          <p class="card-description"> <a href="/customer/add"> Create new </a> </p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th> id </th>
                <th> Name </th>
                <th> Phone </th>
                <th> Day of Birth </th>
                <th> Email </th>
                <th> IDentity </th>
                <th> Func </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($khachang as $item)
               
              <tr>
                <td> {{$item->kh_id}} </td>
                <td> {{$item->kh_ten}} </td>
                <td> {{$item->kh_sdt}} </td>
                <td> {{$item->kh_ngaysinh}} </td>
                <td> {{$item->kh_email}} </td>
                <td> {{$item->kh_cmnd}} </td>
                <td>  
                  Edit/Delete
                </td>
              </tr>

              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

@endsection