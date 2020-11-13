@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create new Price {{ $tour->tour_ten }}</h4>
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
                <input type="hidden" name="tour" value="{{ $tour->tour_id }}">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Price">
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
@endsection
