@extends('layout._Layout')
@section('content')
<div class="row">
<div class="col-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create new a cost</h4>
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
            
            <form class="forms-sample" action="addcp&id={{$id}}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="name">Type Cost</label>
                    <select class="form-control" name="typecost" id="typecost">
                        @foreach ($loaichiphi as $item)
                            <option value="{{ $item->cp_ten }}">{{ $item->cp_ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="code">Bill code</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" placeholder="Bill code">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" class="form-control" id="content" name="content" value="{{ old('content') }}" placeholder="Content">
                </div>
                <div class="form-group">
                    <label for="date">Bill Day</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Price">
                </div>
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit"/>
                <button type="button" id="update" class="btn btn-light">Update</button>
                <button type="reset" class="btn btn-light">Reset</button>
            </form>
        </div>
    </div>
</div>

<div class="col-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Cost Details</h4>
        </p>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Code</th>
              <th>Type Cost</th>
              <th>Name</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
              @if ($chiphi != null)
                @for ($i = 0; $i < count($detail); $i++)
                <tr id="idcost_{{$i}}" onclick="getdata({{$i}}, '{{$detail[$i]->code }}', '{{ $detail[$i]->typecost }}', '{{ $detail[$i]->content }}', '{{ $detail[$i]->price }}', '{{ $detail[$i]->date }}')">
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $detail[$i]->code }}</td>
                    <td>{{ $detail[$i]->typecost }}</td>
                    <td>{{ $detail[$i]->content }}</td>
                    <td>{{ $detail[$i]->price }}</td>
                </tr>
                @endfor
              @endif
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
    function getdata(id, code, typecost, content, price, date)
    {
        $("#id").val(id);
        $("#code").val(code);
        $("#typecost").val(typecost);
        $("#price").val(price);
        $("#content").val(content);
        $("#date").val(date);
    }
    $(document).ready(function(){
        $("#update").click(function(){
            $.ajax({
                type: "post",
                url: "edit&id={{$id}}",
                data: {
                    "_token" : '{{csrf_token()}}',
                    "id" : $("#id").val(),
                    "code" : $("#code").val(),
                    "content" : $("#content").val(),
                    "price" : $("#price").val(),
                    "date" : $("#date").val(),
                    "typecost" : $("#typecost").val(),
                },
                success:function(data)
                {
                    $("tbody").html(data);
                }
            });
        })
    });
</script>
@endsection