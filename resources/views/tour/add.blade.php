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
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit"/>
                <button type="reset" class="btn btn-light">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection