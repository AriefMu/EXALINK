<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class Select2SearchController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function selectSearch(Request $request)
    {
        $pinjam = [];

        if($request->has('q')){
            $search = $request->q;
            $pinjam =User::select("id", "pegawai_nip")
                    ->where('pegawai_nip', 'LIKE', "%$search%")
                    ->get();
        }
        return response()->json($pinjam);
    }
}