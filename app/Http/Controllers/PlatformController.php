<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\platform;
use Illuminate\Support\Facades\DB;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $data = DB::select("SELECT 
        n.id, 
        n.id_admin,
        n.judul, 
        n.deskripsi,
        DATE_FORMAT(n.created_at, '%d %M %Y') as tanggal,
        a.nama as nama
        FROM platforms n
        INNER JOIN admins a ON n.id_admin = a.id
        ORDER BY n.created_at DESC");
        return view("backend/platform", ['tab' => 'platform', 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("backend/platform/add", ['tab' => 'platform']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $platform = new platform;

        $platform->id_admin = 1;
        $platform->judul = $request->judul;
        $platform->deskripsi = $request->deskripsi;

        $platform->save();

        return redirect()
                ->route('platform.index')
                ->with([
                    'success' => 'Konten berhasil diupload'
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $platform = platform::findOrFail($id);
        return view('backend/platform/edit', ['tab' => 'platform', 'platform' => $platform]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $platform = platform::findOrFail($id);

        $platform->update([
            'judul' => $request->judul,
            'platform' => $request->platforms,
        ]);

        return redirect()
            ->route('platform.index')
            ->with([
                'success' => 'Platform berhasil diperbarui'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $platform = platform::findOrFail($id);
        $platform->delete();

        return redirect()
            ->route('platform.index')
            ->with([
                'success' => 'Platform berhasil dihapus'
            ]);
    }
}
