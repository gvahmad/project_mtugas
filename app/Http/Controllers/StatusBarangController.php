<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StatusBarang;
use Illuminate\Http\Request;

class StatusBarangController extends Controller
{
   
    public function index()
    {
        $statusbarang = StatusBarang::with('barang')->get();
        return view('statusbarang.index', compact('statusbarang'));
    }

    
    public function create()
    {
        $barangs = Barang::all();
        return view('statusbarang.create', compact('barangs'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_rusak' => 'required|integer|min:1',
            'tanggal_rusak' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        StatusBarang::create([
            'barang_id' => $barang->id,
            'nama_barang' => $barang->nama_barang,
            'jumlah_rusak' => $request->jumlah_rusak,
            'tanggal_rusak' => $request->tanggal_rusak,
            'keterangan' => $request->keterangan,
        ]);

        $barang->kondisi_rusak += $request->jumlah_rusak;
        $barang->kondisi_bagus -= $request->jumlah_rusak;
        $barang->save();

        return redirect()->route('statusbarang.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    
    public function edit($id)
    {
        $status = StatusBarang::findOrFail($id);
        $barangs = Barang::all();

        return view('statusbarang.edit', compact('status', 'barangs'));
    }

   
    public function update(Request $request, $id)
    {
        $status = StatusBarang::findOrFail($id);

        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_rusak' => 'required|integer|min:1',
            'tanggal_rusak' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $oldBarang = Barang::find($status->barang_id);

       
        $oldBarang->kondisi_rusak -= $status->jumlah_rusak;
        $oldBarang->kondisi_bagus += $status->jumlah_rusak;
        $oldBarang->save();

        
        $barang = Barang::findOrFail($request->barang_id);

        $status->update([
            'barang_id' => $barang->id,
            'nama_barang' => $barang->nama_barang,
            'jumlah_rusak' => $request->jumlah_rusak,
            'tanggal_rusak' => $request->tanggal_rusak,
            'keterangan' => $request->keterangan,
        ]);

        
        $barang->kondisi_rusak += $request->jumlah_rusak;
        $barang->kondisi_bagus -= $request->jumlah_rusak;
        $barang->save();

        return redirect()->route('statusbarang.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    
    public function destroy($id)
    {
        $status = StatusBarang::findOrFail($id);

        
        $barang = Barang::find($status->barang_id);
        $barang->kondisi_rusak -= $status->jumlah_rusak;
        $barang->kondisi_bagus += $status->jumlah_rusak;
        $barang->save();

        $status->delete();

        return redirect()->route('statusbarang.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
