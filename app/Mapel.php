<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['kode_mapel','nama_mapel','semester'];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class)->withPivot(['nilai']);
    }

    public function guru()
    {
        // satu mapel satu guru
        return $this->belongsTo(Guru::class);
    }
}
