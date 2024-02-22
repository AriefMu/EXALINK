<?php

namespace App\Http\Controllers;

use App\Models\ruang ;
use App\Models\lantai ;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'ruang';
        $data['q'] = $request->query('q');
        $query = DB::table('ruang as r')->select('r.id as id','r.nama as ruang','l.nama as lantai')->join('lantai as l','l.id','=','r.lantai_id')->orderBy('r.updated_at','desc')
            
            ->where(function ($query) use ($data) {
            $query->where('r.nama', 'like', '%' . $data['q'] . '%');
            $query->orWhere('l.nama', 'like', '%' . $data['q'] . '%');
            });
            $query2 = lantai::orderBy('updated_at','desc');
           
            $data['lantai']=$query2->get();
            $data['ruan'] = $query->paginate(15)->withQueryString();
            return view('ruang.index', $data);
    }
    public function create()
    {
        return view('ruang.create');
    }
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            
            'nama'     => 'required',
            'lantai'   => 'required'
        ]);

        //upload image
        
        //create ruang
        ruang::create([
            
            'nama'     => $request->nama,
            'lantai_id'   => $request->lantai
        ]);

        //redirect to index
        return redirect()->route('ruang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(ruang $ruang)
    {
        return view('ruang.edit', compact('ruang'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $ruang
     * @return void
     */
    public function update(Request $request, ruang $ruang)
    {
        //validate form
        $this->validate($request, [
            
            'nama'=> 'required',
            'lantai'=> 'required'
        ]);
        
        //check if image is uploaded
        $idl=lantai::where('nama','=',$request->lantai)->get();
        // dd($idl);
        foreach ($idl as $lantai) {
            $ruang->update([
                'nama'=> $request->nama,
                'lantai_id'=> $lantai->id
            ]);
            # code...
        }
            //update ruang without image
           
        

        //redirect to index
        return redirect()->route('ruang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy(ruang $ruang)
    {
        //delete image
        

        //delete post
        $ruang->delete();

        //redirect to index
        return redirect()->route('ruang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function select2Search(Request $request)
    {
        $pinjam = [];

        if($request->has('q')){
            $search = $request->q;
            $pinjam =pegawai::fromselect("nip_baru", "nama")           
                    ->where('nama', 'LIKE', "%$search%")
                    ->orWhere('nip_baru', 'LIKE', "%$search%")
                    ->get();
        }
        return response()->json($pinjam);
    }
}
