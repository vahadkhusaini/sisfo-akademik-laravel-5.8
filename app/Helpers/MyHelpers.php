<?php 
use App\Siswa;
use App\Guru;

function get_ranking()
{
    $siswa = Siswa::all();
    $siswa->map(function($s){
        $s->rata_nilai = $s->rata_nilai();
        return $s;
    });

    $siswa = $siswa->sortByDesc('rata_nilai')->take(5);

    return $siswa;
}

function jumlah_siswa()
{
    return Siswa::count();
}

function jumlah_guru()
{
    return Guru::count();
}