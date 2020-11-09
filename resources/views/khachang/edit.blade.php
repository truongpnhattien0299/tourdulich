@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit the customner</h4>
            <p class="card-description"> <a href="list">&lArr; Back List</a> </p>
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
            
            <form class="forms-sample" action="editcus&id={{ $khachang->kh_id }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $khachang->kh_ten }}" placeholder="Fullname">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $khachang->kh_sdt }}" placeholder="Phone number">
                </div>
                <div class="form-group">
                    <label for="dayOfBirth">Day Of Birth</label>
                    <input type="date" class="form-control" id="dayOfBirth" name="dayOfBirth" value="{{ $khachang->kh_ngaysinh }}" placeholder="Day Of Birth">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $khachang->kh_email }}" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="identity">IDentity card number</label>
                    <input type="text" class="form-control" id="identity" name="identity" value="{{ $khachang->kh_cmnd }}" placeholder="IDentity card number">
                </div>
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit"/>
                <button type="reset" class="btn btn-light">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection