<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Pinjam;
use App\Models\Book;
use Carbon\Carbon;
use App\Http\Requests\StoreHistoryRequest;
use App\Http\Requests\UpdateHistoryRequest;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pustakawan = (auth()->user()->pustakawan) ? 1 : 0;
        $user = auth()->user()->id;
        $now = Carbon::now();

        $bukuTelat = Pinjam::where('tanggal_setor', '>', 'tanggal_kembali')->get();

        foreach ($bukuTelat as $buku) {
            $tanggalKembali = Carbon::parse($buku->tanggal_kembali);
            $lamaTelat = $tanggalKembali->diffInDays($now);

            $denda = 0;
            
            if ($lamaTelat > 30) {
                $denda = 50000;
            } elseif ($lamaTelat > 10) {
                $denda = 20000;
            } else {
                $denda = 0;
            }

            $buku->update(['denda' => $denda]);
        }

        $data = ($pustakawan) ? Pinjam::where('status', 'returned')->get() : Pinjam::where('user_id', $user)->get();
        return view('history', [
            'data' => $data,
            'now' => $now
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
     * @param  \App\Http\Requests\StoreHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHistoryRequest  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHistoryRequest $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }
}
