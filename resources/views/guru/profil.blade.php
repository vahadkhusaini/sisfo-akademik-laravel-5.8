@extends('layout.main')
@section('content')
<div class="panel panel-profile">
    <div class="clearfix">
        <!-- LEFT COLUMN -->
        <div class="profile-left">
            <!-- PROFILE HEADER -->
            <div class="profile-header">
                <div class="overlay"></div>
                <div class="profile-main">
                    <img src="{{ $guru->getAvatar()}}" height="150px" class="img-circle" alt="Avatar">
                    <h3 class="name">{{ $guru->nama_guru }}</h3>
                    <span class="online-status status-available">Available</span>
                </div>
                <div class="profile-stat">
                    <div class="row">
                        <div class="col-md-6 stat-item">
                            {{$guru->mapel->count()}} <span>Mata Pelajaran</span>
                        </div>
                        <div class="col-md-4 stat-item">
                            2174 <span>Points</span>
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
                        <li>Telepon<span>{{ $guru->telepon }}</span></li>
                        <li>Alamat<span>{{ $guru->alamat }}</span></li>
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
                                    Nama Pelajaran
                                </th>
                                <th>
                                    Semester
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru->mapel as $item)
                            <tr>
                                <td>{{$item->nama_mapel}}</td>
                                <td>{{$item->semester}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
