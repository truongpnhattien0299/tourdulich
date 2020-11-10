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
                            <option value="{{ $item->loai_id }}">{{ $item->loai_ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nametour">Name</label>
                    <input type="text" class="form-control" id="nametour" name="nametour" value="{{ old('namecate') }}" placeholder="Name of tour">
                </div>
                <div class="form-group">
                    <label for="txtDescript">Description</label>
                    <textarea class="form-control" id="txtDescript" name="txtDescript" placeholder="Description of Category tour" rows="4">{{ old('txtDescript') }}</textarea>
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
                                <select class="form-control" multiple size="7" id="left">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" id="btn-right">
                                <i class="mdi mdi-arrow-right"></i>
                            </button>

                        </div>
                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" id="btn-left">
                                <i class="mdi mdi-arrow-left"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select class="form-control" multiple size="7" id="right">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon">
                                <i class="mdi mdi-arrow-up"></i>
                            </button>

                        </div>
                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                            <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon">
                                <i class="mdi mdi-arrow-down"></i>
                            </button>
                        </div>
                    </div>
                  </div>
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit"/>
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
            var a=[{
                    id:""
            }];
            var item;
            var city_id;
            $("#btn-right").click(function(){
                var s = $("#left").val();
                for(var i=0;i < a.length;i++){
                    if(a[i]["id"]!=s){

                    }
                }
                alert(a["id"]);
                city_id+="<option>"+$('#city_'+s).html()+"</option>";
                $("#right").html(city_id);
            });
        });
    </script>
@endsection
