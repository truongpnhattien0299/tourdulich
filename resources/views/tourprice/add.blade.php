@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create new Tour Price</h4>
            <p class="card-description"> <a href="listprc">&lArr; Back List</a> </p>
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

            <form class="forms-sample" action="addprc" method="POST">
                @csrf
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Price">
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
                    <input type="date" class="form-control" id="end" name="end" value="{{ old('end') }}" placeholder=" Day End">
                </div>
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit"/>
                <button type="reset" class="btn btn-light">Reset</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#listtour").change(function(){
            $("#start").val(null);
            $("#end").val(null);
        });
        $("#end").change(function(){
                var id = $('#listtour').val();
                var start = $('#start').val();
                var end = $('#end').val();
                $.get("priceend&id="+id+"&start="+start+"&end="+end, function(data){

                });
        });
    });
    </script>
@endsection

