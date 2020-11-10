 @extends('layout._Layout')
@section('content')

<div class="page-header">
    <h3 class="page-title"> Location </h3>
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
          <p class="card-description"> <a href="/Location/addlct"> Create new </a> </p>
          <table class="table table-striped">
            @if (session('notice'))
                <div class="alert alert-danger">{{ session('notice') }}</div>
            @else
              <thead>
                <tr>
                  <th> id </th>
                  <th> Name </th>
                  <th> City </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($location as $item)

                <tr>
                  <td> {{$item->id}} </td>
                  <td> {{$item->dd_ten}} </td>
                  <td> {{$item->city->tp_name}} </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" style="padding: 10%">Select</button>
                      <div class="dropdown-menu" style="min-width: 10px">
                        <a href="editlct&id={{$item->id}}" class="dropdown-item">Edit</a>
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
      var a = confirm("Are you sure you want to DELETE this Location");
      if(a)
        location.replace("delete&id={{$item->id}}");
    }
  </script>
  @endsection
@endif
{{session()->forget('notice')}}
