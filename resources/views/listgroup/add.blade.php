@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create new List Group</h4>
            <p class="card-description"> <a href="listlgrp">&lArr; Back List</a> </p>
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

            <form class="forms-sample" action="addlgrp" method="post">
                @csrf
                <div class="form-group">
                    <label for="listgroup">Group</label>
                    <select class="form-control" id="listgroup" name="group">
                        <option selected>--None--</option>
                        @foreach ($group as $item)
                            <option value="{{$item->doan_id}}">{{$item->doan_name}}</option>
                        @endforeach
                    </select>
                  </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-12" >
                                <div class="row">
                                    <div class="col-sm-4" style="margin:auto 0">
                                        <div>List Customer</div>
                                    </div>
                                    <div class="col-sm-4" >
                                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" id="btn-down"  data-toggle="modal" data-target="#myModal">
                                            <i class="mdi mdi-account-plus"></i>
                                        </button>
                                     <!-- The Modal -->
                                        <div class="modal" id="myModal">
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
                                                        <select class="form-control" size='10' id="listcus"  name="customer" multiple>
                                                            @foreach ($customer as $item)
                                                                <option id="cus_{{$item->kh_id}}" value="{{$item->kh_id}}">{{$item->kh_ten}}</option>
                                                            @endforeach
                                                        </select>
                                                      </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="addlist">Add</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" id="delcus">
                                            <i class="mdi mdi-account-remove"></i>
                                        </button>
                                    </div>
                                </div>
                                <br>
                                <select class="form-control" size="7" id="left" name="ListCustomer[]" multiple>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4" style="margin:auto 0">
                                        <div>List Employee</div>
                                    </div>
                                    <div class="col-sm-4" >
                                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" id="btn-down" data-toggle="modal" data-target="#myModal2">
                                            <i class="mdi mdi-account-plus"></i>
                                        </button>
                                        <!-- The Modal -->
                                        <div class="modal" id="myModal2">
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
                                                        <select class="form-control" size='10' id="listcus2"  name="employee" multiple>
                                                            @foreach ($employee as $item)
                                                        <option id="emp_{{$item->nv_id}}" value="{{$item->nv_id}}">{{$item->nv_ten}}-{{$item->nv_nhiemvu}}</option>
                                                            @endforeach
                                                        </select>
                                                      </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="addlist2">Add</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" id="delemp">
                                            <i class="mdi mdi-account-remove"></i>
                                        </button>
                                    </div>
                                </div>
                                <br>
                                <select class="form-control" multiple size="7" id="right" name="Listemployee[]">
                                </select>
                            </div>
                        </div>
                    </div>
                  </div>
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit"/>
                <button type="reset" class="btn btn-light">Reset</button>
            </form>
        </div>
    </div>
</div>
<script>
      $(document).ready(function(){
          $('#listgroup').change(function(){
                var id = $('#listgroup').val();
                $.get("list&id="+id, function(data){
                    //$("#listcus"+id).html(data);
                });
          });
            var arr = [], opt = {};
            $("#addlist").click(function(){
                if(arr.length==0)
                {
                    var id = $("#listcus").val();
                    var input= (id+"").split(",");
                    if(input.length == 1){
                        var cus_id = "<option selected value='"+input[0]+"'>"+$('#cus_'+input[0]).html()+"</option>";
                        opt = {id: input[0], val: cus_id};
                        arr.push(opt);
                    }else{
                        for(var i=0;i<input.length;i++){
                            var cus_id = "<option selected value='"+input[i]+"'>"+$('#cus_'+input[i]).html()+"</option>";
                            opt = {id: input[i], val: cus_id};
                            arr.push(opt);
                        }
                    }
                    alert("Success");
                }
                else
                {
                    var id = $("#listcus").val();
                    var input= (id+"").split(",");
                    if(input.length == 1){
                        var flag = 0;
                        var i;
                        for(i=0; i<arr.length; i++)
                        {
                            var tmp = arr[i]['id'] * 1;
                            if(input==tmp)
                            {
                                alert("This customer have choosed");
                                flag = 1;
                                break;
                            }
                        }
                        if(flag==0)
                        {
                            var cus_id = "<option selected value='"+ input +"'>"+$('#cus_'+input).html()+"</option>";
                            opt = {id: input, val: cus_id};
                            arr.push(opt);
                            alert("Success");
                        }
                    }else{
                        var flag = 0;
                        var i;
                        for(i=0; i<arr.length; i++)
                        {
                            for(var j=0;j<input.length;j++){
                                var tmp = arr[i]['id'] * 1;
                                var tmp1 = input[j];
                                if(tmp==tmp1)
                                {
                                    alert("One of customer have choosed");
                                    flag = 1;
                                    break;
                                }
                            }
                            if(flag==1)
                            break;
                        }
                        if(flag==0)
                        {
                            for(var i=0;i<input.length;i++){
                                var cus_id = "<option selected value='"+ input[i] +"'>"+$('#cus_'+input[i]).html()+"</option>";
                                opt = {id: input[i], val: cus_id};
                                arr.push(opt);
                            }
                            alert("Success");
                        }
                    }
                }

                var s= "";
                for(let i=0; i<arr.length; i++)
                    s+=arr[i]["val"];
                $("#left").html(s);
            });
            $("#delcus").click(function(){
                var id = $("#left").val();
                var input= (id+"").split(",");
                var s="";
                if(input.length==1){
                    for(let i=0; i<arr.length; i++)
                    {
                        var tmp = arr[i]['id'] * 1;
                        if(tmp==input)
                            arr.splice(i, 1);
                    }
                    for(let i=0; i<arr.length; i++)
                        s+=arr[i]["val"];
                }else{
                    for(let i=0; i<arr.length; i++)
                    {
                        for(var j=0;j<input.length;j++){
                            var tmp = arr[i]['id'] * 1;
                            var tmp2= input[j];
                            if(tmp==tmp2)
                                arr.splice(i, 1);
                        }
                    }
                    for(let i=0; i<arr.length; i++)
                        s+=arr[i]["val"];
                }
                $("#left").html(s);
            });
            var arr2 = [], opt2 = {};
            $("#addlist2").click(function(){
                if(arr2.length==0)
                {
                    var id = $("#listcus2").val();
                    var input= (id+"").split(",");
                    if(input.length == 1){
                        var emp_id = "<option selected value='"+input[0]+"'>"+$('#emp_'+input[0]).html()+"</option>";
                        opt2 = {id: input[0], val: emp_id};
                        arr2.push(opt2);
                    }else{
                        for(var i=0;i<input.length;i++){
                            var emp_id = "<option selected value='"+input[i]+"'>"+$('#emp_'+input[i]).html()+"</option>";
                            opt2 = {id: input[i], val: emp_id};
                            arr2.push(opt2);
                        }
                    }
                    alert("Success");
                }
                else
                {
                    var id = $("#listcus2").val();
                    var input= (id+"").split(",");
                    if(input.length == 1){
                        var flag = 0;
                        var i;
                        for(i=0; i<arr2.length; i++)
                        {
                            var tmp = arr2[i]['id'] * 1;
                            if(input==tmp)
                            {
                                alert("This employee have choosed");
                                flag = 1;
                                break;
                            }
                        }
                        if(flag==0)
                        {
                            var emp_id = "<option selected value='"+ input +"'>"+$('#emp_'+input).html()+"</option>";
                            opt2 = {id: input, val: emp_id};
                            arr2.push(opt2);
                            alert("Success");
                        }
                    }else{
                        var flag = 0;
                        var i;
                        for(i=0; i<arr2.length; i++)
                        {
                            for(var j=0;j<input.length;j++){
                                var tmp = arr2[i]['id'] * 1;
                                var tmp1 = input[j];
                                if(tmp==tmp1)
                                {
                                    alert("One of employee have choosed");
                                    flag = 1;
                                    break;
                                }
                            }
                            if(flag==1)
                            break;
                        }
                        if(flag==0)
                        {
                            for(var i=0;i<input.length;i++){
                                var emp_id = "<option selected value='"+ input[i] +"'>"+$('#emp_'+input[i]).html()+"</option>";
                                opt2 = {id: input[i], val: emp_id};
                                arr2.push(opt2);
                            }
                            alert("Success");
                        }
                    }
                }

                var s= "";
                for(let i=0; i<arr2.length; i++)
                    s+=arr2[i]["val"];
                $("#right").html(s);
            });
            $("#delemp").click(function(){
                var id = $("#right").val();
                var input= (id+"").split(",");
                var s="";
                if(input.length==1){
                    for(let i=0; i<arr2.length; i++)
                    {
                        var tmp = arr2[i]['id'] * 1;
                        if(tmp==input)
                            arr2.splice(i, 1);
                    }
                    for(let i=0; i<arr2.length; i++)
                        s+=arr2[i]["val"];
                }else{
                    for(let i=0; i<arr2.length; i++)
                    {
                        for(var j=0;j<input.length;j++){
                            var tmp = arr2[i]['id'] * 1;
                            var tmp2= input[j];
                            if(tmp==tmp2)
                                arr2.splice(i, 1);
                        }
                    }
                    for(let i=0; i<arr2.length; i++)
                        s+=arr2[i]["val"];
                }
                $("#right").html(s);
            });
        });

</script>
@endsection
