@extends('layout._Layout')
@section('content')

<div class="page-header">
    <h3 class="page-title"> Detailed tour revenue statistics </h3>
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
                    <th> Groups </th>
                    <th> Total Customer </th>
                    <th> Tour Price </th>
                    <th> Total revenue </th>
                    <th> Total cost </th>
                    <th> Interest rate </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($group as $item)
                <tr>
                    <td>{{$item->doan_id}}</td>
                    <td>{{$item->doan_name}}</td>
                    <td>
                        @php
                            $dem=0;
                        @endphp
                        @foreach ($ngdi as $khach)
                            @if ($item->doan_id == $khach->doan_id)
                                @php
                                    $arr = json_decode($khach->nguoidi_dskhach);
                                    $dem = count($arr);
                                @endphp
                            @endif
                        @endforeach
                        {{$dem}}
                    </td>
                    <td>
                        {{$item->price->gia_sotien}}
                    </td>
                    <td>
                        @php
                            $doanhthu = $dem * $item->price->gia_sotien;
                            echo $doanhthu;
                            $chiphi = 0;
                        @endphp
                    </td>
                    <td>
                        @if ($item->chiphi!=null)
                            @php
                                $chiphi = $item->chiphi->chiphi_total;
                                echo $chiphi;
                            @endphp
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        {{$doanhthu - $chiphi}}
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
