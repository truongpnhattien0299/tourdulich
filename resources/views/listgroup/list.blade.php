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
                  <td>
                    <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" id="btn-down" onclick="getcus('{{$item->nguoidi_dskhach}}',{{$item->nguoidi_id}})" data-toggle="modal" data-target="#myModal{{$item->nguoidi_id}}">
                        <i class="mdi mdi mdi-file-document"></i>
                    </button>
                    <!-- The Modal -->
                    <div class="modal" id="myModal{{$item->nguoidi_id}}">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">List Customer</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                            <div class="form-group">
                                    <select class="form-control" id="listcus{{$item->nguoidi_id}}" size='10'>

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
                    </td>
                    <td>
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" onclick="getemp('{{$item->nguoidi_dsnhanvien}}',{{$item->nguoidi_id}})" data-toggle="modal" data-target="#myModal2{{$item->nguoidi_id}}" >
                            <i class="mdi mdi mdi-file-document"></i>
                        </button>
                        <!-- The Modal -->
                        <div class="modal" id="myModal2{{$item->nguoidi_id}}">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                <h4 class="modal-title">List Employee</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                <div class="form-group">
                                        <select class="form-control" size='10' id="listemp{{$item->nguoidi_id}}" name="listemp">

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
                        </td>
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
    function getemp(list,id)
    {
        var arr= (list+"").split(",");
        var text="";
        for(var i=0;i<arr.length-1;i++){
            text+=arr[i];
        }
        $.get("ajaxemp&id="+text, function(data){
            $("#listemp"+id).html(data);
        });
    }
    function getcus(list,id)
    {
        var arr= (list+"").split(",");
        var text="";
        for(var i=0;i<arr.length-1;i++){
            text+=arr[i];
        }
        $.get("ajaxcus&id="+text, function(data){
            $("#listcus"+id).html(data);
        });
    }
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
