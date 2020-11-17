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
                                    <td> {{$item->tour_id}} </td>
                                    <td> {{$item->tour_ten}} </td>
                                    <td>
                                        @php
                                        $i=0;
                                        foreach ($group as $doan)
                                            if ($item->tour_id == $doan->tour_id)
                                                $i++;
                                        echo $i;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        $doanhthu = 0;
                                        foreach($group as $doan)
                                        {
                                            $dem = 0; 
                                            if($item->tour_id == $doan->tour_id)
                                            {
                                                if($doan->visitor!=null)
                                                {
                                                    $arr = json_decode($doan->visitor->nguoidi_dskhach);
                                                    $dem += count($arr);
                                                    $doanhthu+=$dem*$doan->price->gia_sotien;
                                                }
                                            }
                                        }
                                        echo number_format($doanhthu);
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            $total=0;
                                            foreach ($detail as $chiphi)
                                            if ($chiphi->doan->tour_id == $item->tour_id)
                                                $total += $chiphi->chiphi_total;
                                            echo number_format($total);
                                        @endphp
                                    </td>
                                    <td>{{ number_format($doanhthu - $total) }}</td>
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
