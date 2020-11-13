@extends('layout._Layout')
@section('content')

<div class="page-header">
    <h3 class="page-title"> Tour </h3>
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
                  <th> # </th>
                  <th> Name </th>
                  <th> Description </th>
                  <th> Category </th>
                  <th> Destinations </th>
                  <th> Functions </th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($tour as $item)
                  <tr>
                      <td> {{$item->tour_id}} </td>
                      <td> {{$item->tour_ten}} </td>
                      <td> {{$item->tour_mota}} </td>
                      <td> {{$item->loaitour->loai_ten}} </td>
                      <td>
                        @php
                            $i = 1
                        @endphp
                        @foreach ($item->tour_detail->sortBy('ct_thutu') as $detail)
                          {{$detail->location->dd_ten}}
                          @if (count($item->tour_detail)!=$i)
                              -
                          @endif
                          @if ($i%3==0)
                              <br>
                          @endif
                          @php
                              $i++
                          @endphp
                        @endforeach
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" style="padding: 10%">Select</button>
                          <div class="dropdown-menu" style="min-width: 10px">
                            <a href="edit&id={{$item->tour_id}}" class="dropdown-item">Edit</a>
                            <a id="pop-price" onclick="price({{$item->tour_id}})" class="dropdown-item" data-toggle="modal" data-target="#myModal{{$item->tour_id}}">Price</a>
                            <a onclick="del()" id="del" class="dropdown-item" style="cursor: pointer">Delete</a>
                          </div>
                        </div>
                      </td>
                  </tr>
                <div id="popup">
                    <div class="modal" id="myModal{{$item->tour_id}}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">Price {{$item->tour_ten}} </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                            <div class="form-group">
                                    <select class="form-control" size='10' id="listprice" multiple>

                                    </select>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                  </div>
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
    function price(id){
        $.get("popup&id="+id, function(data){
           $('#listprice').html(data);
        });
    }
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
