@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="navbar-left pt-3">
            <h3 class="page-title">Data Siswa</h3>
        </div>
    </div>
    <div class="col-md-4">
        <form method="GET" action="/siswa">
            <div class="input-group">
                <input name="cari" class="form-control mr-sm-2" type="search" placeholder="Cari Siswa"
                    aria-label="Search">
                <span class="input-group-btn"><button type="submit" class="btn btn-primary"><i
                            class="fa fa-search"></i></button></span>
            </div>
        </form>
    </div>

</div>
<div class="col-6">
    @if(session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
    </div>
    @endif

   
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="right">
                     <a href="/siswa/export" class="btn btn-success"><i
                            class="lnr lnr-print"></i>Export To Excel</a>
                     <a href="/siswa/export_pdf" class="btn btn-success"><i
                            class="lnr lnr-print"></i>Export To PDF</a>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i
                            class="lnr lnr-plus-circle"></i> Tambah Data Siswa</a>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                Nama Lengkap
                            </th>
                            <th>
                                Jenis Kelamin
                            </th>
                            <th>
                                Agama
                            </th>
                            <th>
                                Alamat
                            </th>
                            <th>
                                Rata Nilai
                            </th>
                            <th width="20%">
                                Action
                            </th>
                        </tr>
                    </thead>
                
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="/siswa/create" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group {{$errors->has('nisn') ? 'has-error' : ''}}">
                        <label for="nama_depan">NISN</label>
                    <input type="text" name="nisn" class="form-control" id="nisn" placeholder="Masukan NISN" value="{{old('nisn')}}">
                        @if($errors->has('nisn'))
                            <span class="help-block">{{ $errors->first('nisn')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                        <label for="nama_depan">Nama Depan</label>
                        <input type="text" name="nama_depan" class="form-control" id="nama_depan"
                            placeholder="Masukan Nama Depan" value="{{old('nama_depan')}}">
                        @if($errors->has('nama_depan'))
                            <span class="help-block">{{ $errors->first('nama_depan')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="nama_depan">Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control" value="{{old('nama_belakang')}}"
                            placeholder="Masukan Nama Belakang">
                    </div>
                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                        <label for="nama_depan">Email</label>
                        <input type="email" value="{{old('email')}}" name="email" class="form-control"
                            placeholder="Masukan Email">
                        @if($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
                        <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="kelamin">
                            <option value="L" {{old('jenis_kelamin') == 'L' ? 'selected' : ''}}>Laki - laki</option>
                            <option value="P" {{old('jenis_kelamin') == 'P' ? 'selected' : ''}}>Perempuan</option>
                        </select>
                        @if($errors->has('jenis_kelamin'))
                            <span class="help-block">{{ $errors->first('jenis_kelamin')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">
                        <label for="exampleFormControlSelect1">Pilih Agama</label>
                        <select class="form-control" name="agama" id="agama">
                            <option>Islam</option>
                            <option>Kristen</option>
                            <option>Katholik</option>
                            <option>Hindu</option>
                            <option>Budha</option>
                        </select>
                        @if($errors->has('agama'))
                            <span class="help-block">{{ $errors->first('agama')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" required name="alamat" rows="3">{{old('alamat')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Foto</label>
                        <input type="file" class="form-control" name="foto">
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{route('ajax.get.data.siswa')}}",
                columns:[
                    {data:"nama_lengkap", name:"nama_lengkap"},
                    {data:"jns_kelamin", name:"jns_kelamin"},
                    {data:"agama", name:"agama"},
                    {data:"alamat", name:"alamat"},
                    {data:"rata_nilai", name:"rata_nilai"},
                    {data:"aksi", name:"aksi"},
                ]
            });

            $('#example').on('click', '.delete',function (){
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Hapus data siswa",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                            window.location = "/siswa/"+id+"/delete";
                        }
                    })
                });
        });
    </script>

@endsection