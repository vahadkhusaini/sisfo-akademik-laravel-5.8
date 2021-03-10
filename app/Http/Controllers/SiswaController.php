<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\Mapel;
use App\Exports\SiswaExport; 
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari'))
        {
            $data_siswa = Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        }else
        {
            $data_siswa = Siswa::all();
        }
        return view('siswa.index', compact('data_siswa'));

    }

    public function create(Request $request)
    {
        $this->validate($request,
            [
                'nisn' => 'required|unique:siswa',
                'nama_depan' => 'required',
                'email' => 'required|email|unique:users',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'avatar' => 'mines:jpg, jpeg, png'
            ]
        );
        
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->nisn);
        $user->remember_token = str_random(60);
        $user->save();

        $siswa = Siswa::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
            $siswa->avatar = $request->file('foto')->getClientOriginalName();
            $siswa->save(); 
        }

        return redirect('/siswa')->with('sukses', 'Data Berhasil Disimpan!');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa/edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
            $siswa->avatar = $request->file('foto')->getClientOriginalName();
            $siswa->save(); 
        }
        return redirect('/siswa')->with('sukses', 'Data Berhasil Diupdate!');
    }

    public function delete(Siswa $siswa)
    {
        $siswa->delete($siswa);
        return redirect('/siswa')->with('sukses', 'Data Berhasil Dihapus!');
    }

    public function profil(Siswa $siswa)
    {
        $mapel = Mapel::all();

        // Data untuk chart
        $categories = [];
        $data = [];
        foreach($mapel as $mp){
            if($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()){
                $categories[] = $mp->nama_mapel;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }

        return view('siswa.profil', compact('siswa','mapel', 'categories', 'data'));
    }

    public function add_nilai(Request $request, Siswa $siswa)
    {

        if($siswa->mapel()->where('mapel_id', $request->mapel)->exists()){
            return redirect('siswa/'.$siswa->id.'/profil')->with('error','Data Nilai Sudah Dimasukkan');
        }

        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect('siswa/'.$siswa->id.'/profil')->with('sukses','Nilai Berhasil Dimasukkan');
    }

    public function export()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function export_pdf()
    {
        $siswa = Siswa::all();
        $pdf = PDF::loadView('export.pdf', compact('siswa'));
        return $pdf->download('siswa.pdf');
    }

    public function getdatasiswa()
    {
        $siswa = Siswa::select('siswa.*');

        return \DataTables::eloquent($siswa)
        ->addColumn('nama_lengkap', function($s){
            return $s->nama_lengkap();
        })
        ->addColumn('rata_nilai', function($s){
            return $s->rata_nilai();
        })
        ->addColumn('jns_kelamin', function($s){
            return $s->jenis_kelamin == 'L' ? "Laki-laki" : "Perempuan";
        })
        ->addColumn('aksi', function($s){
            return '<div class="d-inline">
                        <a href="/siswa/'.$s->id.'/edit" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-xs delete" data-id="'.$s->id.'"><i class="fa fa-trash"></i></a>
                        <a href="/siswa/'.$s->id.'/profil" class="btn btn-info btn-xs"><i class="fa fa-info"></i></a>
                    </div>';
        })
        ->rawColumns(['nama_lengkap','jns_kelamin','rata_nilai','aksi'])
        ->toJson();
    }

    public function my_profile()
    {
        $siswa = auth()->user()->siswa;
        return view('siswa.my_profil', compact('siswa'));
    }
}
