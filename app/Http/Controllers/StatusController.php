<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\status;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'status';
        $data['q'] = $request->query('q');
        $query = status::orderBy('updated_at','asc')
            
            ->where(function ($query) use ($data) {
            $query->where('nama', 'like', '%' . $data['q'] . '%');
            });
            // $query2 = lantai::orderBy('updated_at','desc');
           
            // $data['lantai']=$query2->get();
            $data['status'] = $query->paginate(15)->withQueryString();
            return view('status.index', $data);
    }
    public function create()
    {
        return view('status.create');
    }
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            
            'nama'     => 'required',
            
        ]);

        //upload image
        
        //create status
        status::create([
            
            'nama'     => $request->nama,
            
        ]);

        //redirect to index
        return redirect()->route('status.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(status $status)
    {
        return view('status.edit', compact('status'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $status
     * @return void
     */
    public function update(Request $request, status $status)
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
            $status->update([
                'nama'=> $request->nama,
                'lantai_id'=> $lantai->id
            ]);
            # code...
        }
            //update status without image
           
        

        //redirect to index
        return redirect()->route('status.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy(status $status)
    {
        //delete image
        

        //delete post
        $status->delete();

        //redirect to index
        return redirect()->route('status.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
}
