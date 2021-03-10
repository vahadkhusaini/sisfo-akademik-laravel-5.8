@extends('layout.main')
@section('header')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection
@section('content')
<div class="panel panel-profile">
    <div class="col-6">
    @if(session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{session('error')}}
    </div>
    @endif
</div>
    <div class="clearfix">
        <!-- LEFT COLUMN -->
        <div class="profile-left">
            <!-- PROFILE HEADER -->
            <div class="profile-header">
                <div class="overlay"></div>
                <div class="profile-main">
                    <img src="{{ $siswa->getAvatar()}}" height="150px" class="img-circle" alt="Avatar">
                    <h3 class="name">{{ $siswa->nama_depan.' '.$siswa->nama_belakang}}</h3>
                    <span class="online-status status-available">Available</span>
                </div>
                <div class="profile-stat">
                    <div class="row">
                        <div class="col-md-6 stat-item">
                            {{$siswa->mapel->count()}} <span>Mata Pelajaran</span>
                        </div>
                        <div class="col-md-4 stat-item">
                            {{$siswa->rata_nilai()}} <span>Rata - rata</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE HEADER -->
            <!-- PROFILE DETAIL -->
            <div class="profile-detail">
                <div class="profile-info">
                    <h4 class="heading">Data Diri</h4>
                    <ul class="list-unstyled list-justify">
                        <li>NISN<span>{{ $siswa->nisn}}</span></li>
                        <li>Jenis Kelamin<span>{{ $siswa->jenis_kelamin == "L" ? "laki-laki" : "Perempuan"}}</span></li>
                        <li>Agama <span>{{ $siswa->agama }}</span></li>
                        <li>Alamat <span>{{ $siswa->alamat }}</span></li>
                    </ul>
                </div>
                <div class="text-center"><a href="#" class="btn btn-primary">Edit Profile</a></div>
            </div>
            <!-- END PROFILE DETAIL -->
        </div>
        <!-- END LEFT COLUMN -->
        <!-- RIGHT COLUMN -->
        <div class="profile-right">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-nilai"><i
                    class="lnr lnr-plus-circle"></i> Tambah Nilai Siswa</a>
            <!-- END AWARDS -->
            <!-- TABBED CONTENT -->
            <div class="custom-tabs-line tabs-line-bottom left-aligned">
                <ul class="nav" role="tablist">
                    <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Mata Pelajaran</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Kode
                                </th>
                                <th>
                                    Nama Pelajaran
                                </th>
                                <th>
                                    Semester
                                </th>
                                <th>
                                    Nilai
                                </th>
                                <th>
                                    Guru
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa->mapel as $item)
                            <tr>
                                <td>{{$item->kode_mapel}}</td>
                                <td>{{$item->nama_mapel}}</td>
                                <td>{{$item->semester}}</td>
                                <td><a href="#" class="edit-nilai" data-type="text" data-pk="{{$item->id}}" data-url="/api/siswa/{{$siswa->id}}/edit_nilai" data-title="Masukkan Nilai">{{$item->pivot->nilai}}</a></td>
                                <td><a href="/guru/{{$item->guru_id}}/profil">{{$item->guru->nama_guru}}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel">
                    <div id="chart-nilai">

                    </div>
                </div>
            </div>
            <!-- END TABBED CONTENT -->
        </div>
        <!-- END RIGHT COLUMN -->
        {{-- <div class="profile-right">

        </div> --}}
        <!-- END RIGHT COLUMN -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-tambah-nilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Modal Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/siswa/{{$siswa->id}}/add_nilai" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{$errors->has('mapel') ? 'has-error' : ''}}">
                        <label for="exampleFormControlSelect1">Mata Pelajaran</label>
                        <select class="form-control" name="mapel" id="mapel">
                            @foreach ($mapel as $item)
                                <option value="{{$item->id}}">{{$item->nama_mapel}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('mapel'))
                        <span class="help-block">{{ $errors->first('mapel')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('nilai') ? 'has-error' : ''}}">
                        <label for="nama_depan">Nilai</label>
                        <input type="number" name="nilai" class="form-control" id="nisn" placeholder="Masukan Nilai"
                            value="{{old('nilai')}}">
                        @if($errors->has('nilai'))
                        <span class="help-block">{{ $errors->first('nilai')}}</span>
                        @endif
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('chart-nilai', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Laporan Nilai Siswa'
            },
            xAxis: {
                categories: {!!json_encode($categories)!!},
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nilai'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Nilai',
                data: {!!json_encode($data)!!}
            }]
        });

        $(document).ready(function() {
            $('.edit-nilai').editable();
        });
    </script>
@endsection
