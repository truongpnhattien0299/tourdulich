@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create new category tour</h4>
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
            
            <form class="forms-sample" action="addcate" method="POST">
                @csrf
                <div class="form-group">
                    <label for="namecate">Name</label>
                    <input type="text" class="form-control" id="namecate" name="namecate" value="{{ old('namecate') }}" placeholder="Name of Category tour">
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