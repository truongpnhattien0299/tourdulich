@extends('layout._Layout')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit the Group</h4>
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

            <form class="forms-sample" action="editgrp&id={{ $Group->doan_id }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $Group->doan_name }}" placeholder="Fullname">
                </div>
                <div class="form-group">
                    <label for="tour">Tour</label>
                    <input type="text" class="form-control" id="tour" name="tour" value="{{ $Group->tour_id }}" placeholder="Tour">
                </div>
                <div class="form-group">
                    <label for="start">Day Start</label>
                    <input type="date" class="form-control" id="start" name="start" value="{{ $Group->doan_ngaydi }}" placeholder="Day Start">
                </div>
                <div class="form-group">
                    <label for="end">Day End</label>
                    <input type="date" class="form-control" id="end" name="end" value="{{ $Group->doan_ngayve }}" placeholder="Day End">
                </div>
                <div class="form-group">
                    <label for="mission">Mission</label>
                    <input type="text" class="form-control" id="mission" name="mission" value="{{ $Group->nv_nhiemvu }}" placeholder="Mission">
                </div>
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit"/>
                <button type="reset" class="btn btn-light">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection
