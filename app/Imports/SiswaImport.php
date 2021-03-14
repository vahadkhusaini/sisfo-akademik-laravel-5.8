<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Siswa;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {
        
        foreach($collection as $key => $row){
            
            if($key >= 1)
            {
                $nama = explode(" ", $row[2]);
                
                $user = new \App\User;
                $user->role = 'siswa';
                $user->name = $nama[0];
                $user->email = $row[6];
                $user->password = bcrypt($row[1]);
                $user->remember_token = str_random(60);
                $user->save();

                Siswa::create([
                    'user_id' => $user->id,
                    'nisn' => $row[1],
                    'nama_depan' => $nama[0],
                    'nama_belakang' => $nama[1] == '' ? '' : $nama[1],
                    'jenis_kelamin' => $row[3],
                    'agama' => $row[4],
                    'alamat' => $row[5],
                    'email' => $row[6]
                ]);
            }
        }
    }
}
