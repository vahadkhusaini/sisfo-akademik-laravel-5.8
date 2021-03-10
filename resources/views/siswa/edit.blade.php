@extends('layout.main')

@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="col-12">
            <h3 class="page-title">Edit Data Siswa</h3>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body">
                <form action="/siswa/{{$siswa->id}}/update" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="nama_depan">NISN</label>
                        <input type="text" name="nisn" class="form-control" id="nisn"
                        placeholder="Masukan NISN"
                        value="{{$siswa->nisn}}">
                    </div>
                    <div class="form-group">
                        <label for="nama_depan">Nama Depan</label>
                        <input type="text" name="nama_depan" class="form-control" id="nama_depan"
                            placeholder="Masukan Nama Depan" value="{{$siswa->nama_depan}}">
                    </div>
                    <div class="form-group">
                        <label for="nama_depan">Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control" id="nama_belakang"
                            placeholder="Masukan Nama Belakang" value="{{$siswa->nama_belakang}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="kelamin">
                            <option {{$siswa->jenis_kelamin == 'L' ? 'selected' : '' }} value="L">Laki - laki</option>
                            <option {{$siswa->jenis_kelamin == 'P' ? 'selected' : '' }} value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Agama</label>
                        <select class="form-control" name="agama" id="agama">
                            <option {{$siswa->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option {{$siswa->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option {{$siswa->agama == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                            <option {{$siswa->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option {{$siswa->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat"
                            rows="3">{{ $siswa->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Foto</label>
                        <input type="file" class="form-control" name="foto" id="alamat">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
