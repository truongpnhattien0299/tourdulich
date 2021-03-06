@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create new Group</h4>
            <p class="card-description"> <a href="listgrp">&lArr; Back List</a> </p>
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

            <form class="forms-sample" action="addgrp" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Name of group">
                </div>
                <div class="form-group">
                    <label for="listtour">Tour</label>
                    <select class="form-control" id="listtour" name="tour">
                        @foreach ($tour as $item)
                            <option value="{{$item->tour_id}}">{{$item->tour_ten}}</option>
                        @endforeach
                    </select>
                </div>
                  
                <div class="form-group">
                    <label for="start">Day Start</label>
                    <input type="date" class="form-control" id="start" name="start" value="{{ old('start') }}" placeholder="Day Start">
                </div>
                <div class="form-group">
                    <label for="end">Day End</label>
                    <input type="date" class="form-control" id="end" name="end" value="{{ old('start') }}" placeholder="Day End">
                </div>
                <div class="form-group">
                    <label for="details">Details</label>
                    <textarea rows="5" type="text" class="form-control" id="details" name="details" placeholder="Details">{{ old('details') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tourprice">Tour Price</label>
                    <select class="form-control" id="abc" name="tourprice">
                        <option value="">-- None</option>
                    </select>
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
        $("#listtour").change(function(){
            document.getElementById("start").value=null;
            $("#start").change(function(){
                var id = $('#listtour').val();
                var start = $('#start').val();
                $.get("price&id="+id+"&start="+start, function(data){
                    $("#abc").html(data);
                });
            });
        });
        
    });
</script>
@endsection
