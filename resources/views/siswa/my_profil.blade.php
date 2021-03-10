@extends('layout.main')
@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
    rel="stylesheet" />
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
                    <h3 class="name">{{ $siswa->nama_depan.' '.$siswa->nama_belakang}}
                    </h3>
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
                        <li>Jenis
                            Kelamin<span>{{ $siswa->jenis_kelamin == "L" ? "laki-laki" : "Perempuan"}}</span>
                        </li>
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
                                <td>{{$item->pivot->nilai}}</td>
                                <td>{{$item->guru->nama_guru}}</td>
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

@endsection
