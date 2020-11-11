@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create new tour</h4>
            <p class="card-description"> <a href="listcate">&lArr; Back List</a> </p>
            @if (session('error'))
                <div id="idError">
                    <div class="alert alert-danger">{{ session('error') }}</div>
                </div>
                <script>
                    $(document).ready(function(){
                        $(window).click(function(){
                            $("#idError").slideUp("slow");
                        });
                    });
                </script>
            @endif

            <form class="forms-sample" action="addtour" method="POST">
                @csrf
                <div class="form-group">
                    <label for="catetour">Category of tour</label>
                    <select class="form-control" id="catetour" name="catetour">
                        @foreach ($loai as $item)
                            @if ($tour->loai_id==$item->loai_id)
                                <option selected value="{{ $item->loai_id }}">{{ $item->loai_ten }}</option>
                            @else
                                <option value="{{ $item->loai_id }}">{{ $item->loai_ten }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nametour">Name</label>
                    <input type="text" class="form-control" id="nametour" name="nametour" value="{{ $tour->tour_ten }}" placeholder="Name of tour">
                </div>
                <div class="form-group">
                    <label for="txtDescript">Description</label>
                    <textarea class="form-control" id="txtDescript" name="txtDescript" placeholder="Description of Category tour" rows="4">{{ $tour->tour_mota }}</textarea>
                </div>
                <div class="form-group">
                    <label for="city">Choose city</label>
                    <select class="form-control" id="city" name="city">
                        <option value="-1" selected>--None</option>
                        @foreach ($city as $item)
                            <option value="{{ $item->tp_id }}">{{ $item->tp_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select class="form-control" size="7" id="left">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" for="left" id="btn-right">
                                <i class="mdi mdi-arrow-right"></i>
                            </button>

                        </div>
                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" for="left" id="btn-left">
                                <i class="mdi mdi-arrow-left"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select class="form-control" multiple size="7" id="right" name="slLocation[]">
                                    <script>
                                        var arr= []; var opt ={};
                                    </script>
                                    @foreach ($tourdetail as $item)
                                        <option value="{{ $item->location->id }}">{{ $item->location->dd_ten }}</option>
                                        <script>
                                            var id = "{{ $item->location->id }}";
                                            var city_id = "<option selected value='"+ id +"'>{{ $item->location->dd_ten }}</option>";
                                            opt = {id:id, val: city_id};
                                            arr.push(opt);
                                        </script>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" for="right" id="btn-up">
                                <i class="mdi mdi-arrow-up"></i>
                            </button>

                        </div>
                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" for="right" id="btn-down">
                                <i class="mdi mdi-arrow-down"></i>
                            </button>
                        </div>
                    </div>
                  </div>
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit" id="submit" />
                <button type="reset" class="btn btn-light">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#city").change(function(){
                var id = $(this).val();
                $.get("ajax&id="+id, function(data){
                    $("#left").html(data);
                });
            });
            $("#btn-right").click(function(){
                if(arr.length==0)
                {
                    var id = $("#left").val();
                    var city_id = "<option selected value='"+id+"'>"+$('#city_'+id).html()+"</option>";
                    opt = {id: id, val: city_id};
                    arr.push(opt);
                }
                else
                {
                    var id = $("#left").val();
                    var flag = 0;
                    var i;
                    for(i=0; i<arr.length; i++)
                    {
                        var tmp = arr[i]['id'] * 1;
                        if(id==tmp)
                        {
                            alert("This location have choosed");
                            flag = 1;
                            break;
                        }
                    }
                    if(flag==0)
                    {
                        var city_id = "<option selected value='"+ id +"'>"+$('#city_'+id).html()+"</option>";
                        opt = {id: id, val: city_id};
                        arr.push(opt);
                    }
                }
                var s= "";
                for(let i=0; i<arr.length; i++)
                    s+=arr[i]["val"];
                $("#right").html(s);
            });

            $("#btn-left").click(function(){
                var id = $("#right").val();
                var s="";
                for(let i=0; i<arr.length; i++)
                {
                    var tmp = arr[i]['id'] * 1;
                    if(tmp==id)
                        arr.splice(i, 1);
                }
                for(let i=0; i<arr.length; i++)
                    s+=arr[i]["val"];
                $("#right").html(s);
            });

            $("#btn-up").click(function(){
                var id = $("#right").val();
                var s="";
                for(let i=0; i<arr.length; i++)
                {
                    var tmp = arr[i]['id'] * 1;
                    if(tmp==id && i!=0)
                    {
                        objtmp = {id:arr[i]["id"], val:arr[i]["val"]};
                        arr[i] = arr[i-1];
                        arr[i-1] = objtmp;
                    }
                }
                for(let i=0; i<arr.length; i++)
                    s+=arr[i]["val"];
                $("#right").html(s);
            });

            $("#btn-down").click(function(){
                var id = $("#right").val();
                var s="";
                for(let i=arr.length-1; i>=0; i--)
                {
                    var tmp = arr[i]['id'] * 1;
                    if(tmp==id && i!=arr.length-1)
                    {
                        objtmp = {id:arr[i]["id"], val:arr[i]["val"]};
                        arr[i] = arr[i+1];
                        arr[i+1] = objtmp;
                    }
                }
                for(let i=0; i<arr.length; i++)
                    s+=arr[i]["val"];
                $("#right").html(s);
            });
        });
    </script>
@endsection
