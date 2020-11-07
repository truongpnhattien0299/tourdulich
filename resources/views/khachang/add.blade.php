@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create new customner</h4>
            <p class="card-description"> <a href="customer/list">&lArr; Back List</a> </p>
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form class="forms-sample" action="add" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Fullname">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone number">
                </div>
                <div class="form-group">
                    <label for="dayOfBirth">Day Of Birth</label>
                    <input type="date" class="form-control" id="dayOfBirth" name="dayOfBirth" value="{{ old('dayOfBirth') }}" placeholder="Day Of Birth">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="identity">IDentity card number</label>
                    <input type="text" class="form-control" id="identity" name="identity" value="{{ old('identity') }}" placeholder="IDentity card number">
                </div>
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit"/>
                <button type="reset" class="btn btn-light">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection