<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function edit_nilai(Request $request, $id){
        $siswa = Siswa::find($id);
        $siswa->mapel()->updateExistingPivot($request->pk, ['nilai' => $request->value]);
    }
}
