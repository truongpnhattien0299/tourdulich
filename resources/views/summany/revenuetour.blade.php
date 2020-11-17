@extends('layout._Layout')
@section('content')

<div class="page-header">
    <h3 class="page-title"> Tour revenue statistics </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">List</h4>
          <table class="table table-striped">
              <thead>
                <tr>
                    <th> # </th>
                    <th> Tour </th>
                    <th> Total number of Groups </th>
                    <th> Total revenue </th>
                    <th> Total cost </th>
                    <th> Interest rate </th>
                    <th> Detail </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tour as $item)
                <tr>
                    <td> {{$item->id}} </td>
                    <td> {{$item->tour_ten}} </td>
                    <td>  
                        @php
                            $i=0;
                        @endphp
                        @foreach ($group as $doan)
                            @if ($item->tour_id == $doan->tour_id)
                                @php
                                    $i++;
                                @endphp
                            @endif
                        @endforeach
                        {{$i}}
                    </td>
                    <td>
                        @php
                            $total=0;
                        @endphp
                        @foreach ($detail as $chiphi)
                            @if ($chiphi->doan->tour_id == $item->tour_id)
                                @php
                                    $total += $chiphi->chiphi_total;
                                @endphp
                                {{$total}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="revenuedetailtour&id={{$item->tour_id}}"><button type="button" class="btn btn-outline-primary btn-fw">Detail</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

@endsection
