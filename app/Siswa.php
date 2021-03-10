<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "siswa";
    protected $fillable = ['nisn','nama_depan', 'nama_belakang', 'jenis_kelamin', 'agama', 'alamat','avatar','email'];

    public function getAvatar()
    {
        if(!$this->avatar)
        {
            return asset('images/default.jpeg');
        }

        return asset('images/'.$this->avatar); 
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimeStamps();
    }

    public function nama_lengkap()
    {
        return $this->nama_depan.' '.$this->nama_belakang;
    }

    public function rata_nilai()
    {
        $total = 0;
        $rata2 = 0;
        $hasil_akhir = 0;
        foreach($this->mapel as $mapel){
            $total += $mapel->pivot->nilai;
            $rata2++;
        }

        $hasil_akhir = @(round($total/$rata2));

        return $hasil_akhir > 0 ? $hasil_akhir : 0;
    }
}
