<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['nama_guru','telepon','alamat'];

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
        // satu guru punya banyak mapel
        return $this->hasMany(Mapel::class);
    }
}
