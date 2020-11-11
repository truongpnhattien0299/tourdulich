@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit the Tour Price</h4>
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

            <form class="forms-sample" action="editprc&id={{ $tourprice->gia_id }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ $tourprice->gia_sotien }}" placeholder="Price">
                </div>
                <div class="form-group">
                    <label for="listtour">Tour</label>
                    <select class="form-control" id="listtour" name="tour">
                        @foreach ($tour as $item)
                            @if($item->tour_id == $tourprice->tour_id)
                                <option value="{{$item->tour_id}}" selected>{{$item->tour_ten}}</option>
                            @else
                                <option value="{{$item->tour_id}}">{{$item->tour_ten}}</option>
                            @endif
                        @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label for="start">Day Start</label>
                    <input type="date" class="form-control" id="start" name="start" value="{{ $tourprice->gia_tungay }}" placeholder="Day Start">
                </div>
                <div class="form-group">
                    <label for="end">Day End</label>
                    <input type="date" class="form-control" id="end" name="end" value="{{ $tourprice->gia_denngay }}" placeholder="Day End">
                </div>
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit"/>
                <button type="reset" class="btn btn-light">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection
