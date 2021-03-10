@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Rangking 5 besar</h3>
            </div>
            <div class="panel-body">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Rata - rata nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (get_ranking() as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama_depan}}</td>
                            <td>{{$item->rata_nilai}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric">
            <span class="icon"><i class="fa fa-user"></i></span>
            <p>
                <span class="number">{{jumlah_siswa()}}</span>
                <span class="title">Siswa</span>
            </p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric">
            <span class="icon"><i class="fa fa-user"></i></span>
            <p>
                <span class="number">{{jumlah_guru()}}</span>
                <span class="title">Guru</span>
            </p>
        </div>
    </div>
</div>
@endsection
