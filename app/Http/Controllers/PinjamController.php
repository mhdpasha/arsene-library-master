<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pinjam;
use App\Models\Buku;
use Carbon\Carbon;


class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pustakawan = (auth()->user()->pustakawan) ? 1 : 0;
        $queryPustakawan = Pinjam::where('history', null)->orderBy('id', 'DESC')->get();
        $queryAnggota = Buku::all();

        return view('pinjam-buku', [
            'data' => ($pustakawan) ? $queryPustakawan : $queryAnggota,
            'rekomendasi' => Buku::inRandomOrder()->limit(3)->get(),
            'pustakawan' => $pustakawan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required',
            'user_id' => 'required',
            'message' => 'required|max:100',
            'tanggal_kembali' => 'required'
        ]);
        $validated['tanggal_pinjam'] = Carbon::now();
        
        Pinjam::create($validated);
            
        return view('pinjam-berhasil', [
            'buku' => Buku::find($request->buku_id) 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePinjamRequest  $request
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjam $pinjam)
    {
        $user = $pinjam->user->name;
        $buku = Buku::find($pinjam->buku_id);
        $pinjam->update(['status' => $request->status]);

        if($request->returned) {
            $pinjam->update([
                'tanggal_setor' => Carbon::now(),
                'status' => 'returned',
                'history' => 1
            ]);
            $buku->update([
                'stok' => $buku->stok + 1
            ]);
            return redirect()->back()->with('added', "Buku {$buku->judul} telah dikembalikan");
        }

        if($pinjam->status == 'accepted') {
            $request['uuid'] = Str::orderedUuid();
            $request['tanggal_pinjam'] = Carbon::now();

            $pinjam->update($request->all());
            $buku->update([
                'stok' => $buku->stok - 1
            ]);
            return redirect()->back()->with('added', "Buku {$buku->judul} telah dipinjam oleh {$user}");
        }
        else {
            return redirect()->back()->with('added', "Request {$user} telah ditolak.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
