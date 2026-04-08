<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Peminjaman;
use Carbon\Carbon;
use App\Models\Notifikasi;


class BukuController extends Controller
{
    public function index(Request $request)
    {
        $buku = Buku::all();
        return view('petugas.daftarbuku.buku', compact('buku'));
    }


    public function katalog()
    {
        $buku = Buku::all();
        return view('anggota.daftarbuku.buku', compact('buku'));
    }



    public function create()
    {
        return view('petugas.daftarbuku.tambahbuku');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku'    => 'required|unique:buku,kode_buku',
            'judul_buku'   => 'required',
            'penulis'      => 'required',
            'sinopsis'     => 'nullable',
            'tahun_terbit' => 'required|date',
            'stock_buku'   => 'required|integer|min:0',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar 
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Buku $buku)
    {
        return view('petugas.daftarbuku.editbuku', ["buku" => $buku]);
    }

    public function update(Request $request, Buku $buku)
    {


        $validated = $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku,' . $buku->id,
            'judul_buku'   => 'required',
            'penulis'      => 'required',
            'tahun_terbit' => 'required|date',
            'sinopsis'     => 'nullable',
            'stock_buku'   => 'required|integer|min:0',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($buku->cover_image && Storage::disk('public')->exists($buku->cover_image)) {
                Storage::disk('public')->delete($buku->cover_image);
            }
        }


        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $buku->update($validated);

        return redirect()->route('buku.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Buku $buku)
    {

        if ($buku->cover_image && Storage::disk('public')->exists($buku->cover_image)) {
            Storage::disk('public')->delete($buku->cover_image);
        }

        $buku->delete($buku->id);

        return redirect()->route('buku.index')->with('success', 'Data berhasil dihapus');
    }


    public function pinjam(Request $request, $id)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after:tanggal_pinjam',
        ]);

        // CEK MAKSIMAL 3 BUKU
        $jumlah = Peminjaman::where('user_id', auth()->id())
            ->whereIn('status', [
                'pending',
                'dipinjam',
                'menunggu_kembali',
                'terlambat'
            ])
            ->count();

        if ($jumlah >= 3) {
            return back()->with('error', 'Maksimal hanya bisa meminjam 3 buku');
        }

        // CEK STOCK
        $buku = Buku::findOrFail($id);

        if ($buku->stock_buku <= 0) {
            return back()->with('error', 'Buku sedang tidak tersedia');
        }

        // VALIDASI DURASI
        $selisih = Carbon::parse($request->tanggal_pinjam)
            ->diffInDays($request->tanggal_jatuh_tempo);

        if ($selisih < 3 || $selisih > 30) {
            return back()->with('error', 'Minimal 3 hari, maksimal 30 hari');
        }

        // SIMPAN
        Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengajuan peminjaman berhasil');
    }

    public function riwayat()
    {
        $data = Peminjaman::with('buku')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        // AUTO UPDATE TERLAMBAT
        foreach ($data as $item) {
            if (
                $item->status == 'dipinjam' &&
                now()->gt($item->tanggal_jatuh_tempo)
            ) {
                $telat = now()->diffInDays($item->tanggal_jatuh_tempo);
                $denda = $telat * 1000;

                $item->update([
                    'status' => 'terlambat',
                    'denda' => $denda
                ]);
            }
        }

        // NOTIF
        $notifikasi = Notifikasi::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        foreach ($data as $item) {
            if (
                $item->status == 'dipinjam' &&
                now()->addDay()->toDateString() == \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->toDateString()
            ) {
                // CEK BIAR GA DOUBLE NOTIF
                $sudahAda = Notifikasi::where('user_id', $item->user_id)
                    ->where('pesan', 'like', '%' . $item->buku->judul_buku . '%')
                    ->where('pesan', 'like', '%jatuh tempo%')
                    ->exists();

                if (!$sudahAda) {
                    Notifikasi::create([
                        'user_id' => $item->user_id,
                        'pesan' => 'Buku "' . $item->buku->judul_buku . '" akan jatuh tempo besok'
                    ]);
                }
            }
        }

        return view('anggota.riwayat.pinjaman', compact('data', 'notifikasi'));
    }

    public function peminjaman()
    {
        $data = Peminjaman::with('buku', 'user')
            ->whereIn('status', ['pending', 'dipinjam'])
            ->latest()
            ->get();

        // AUTO TERLAMBAT
        foreach ($data as $item) {
            if (
                $item->status == 'dipinjam' &&
                now()->gt($item->tanggal_jatuh_tempo)
            ) {
                $telat = now()->diffInDays($item->tanggal_jatuh_tempo);
                $denda = $telat * 1000;

                $item->update([
                    'status' => 'terlambat',
                    'denda' => $denda
                ]);
            }
        }

        return view('petugas.peminjaman.buku', compact('data'));
    }

    public function pengembalian()
    {
        $data = Peminjaman::with('buku', 'user')
            ->whereIn('status', ['menunggu_kembali', 'terlambat'])
            ->latest()
            ->get();

        // AUTO UPDATE TERLAMBAT
        foreach ($data as $item) {
            if (
                $item->status == 'dipinjam' &&
                now()->gt($item->tanggal_jatuh_tempo)
            ) {
                $telat = now()->diffInDays($item->tanggal_jatuh_tempo);
                $denda = $telat * 1000;

                $item->update([
                    'status' => 'terlambat',
                    'denda' => $denda
                ]);
            }
        }

        return view('petugas.pengembalian.buku', compact('data'));
    }
    // Kembalikan 
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status == 'dipinjam') {
            $peminjaman->update([
                'status' => 'menunggu_kembali'
            ]);
        }

        return back()->with('success', 'Menunggu konfirmasi pengembalian');
    }

    // Approve
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status == 'pending') {
            $peminjaman->update([
                'status' => 'dipinjam'
            ]);

            $peminjaman->buku->decrement('stock_buku');

            Notifikasi::create([
                'user_id' => $peminjaman->user_id,
                'pesan' => 'Peminjaman buku "' . $peminjaman->buku->judul_buku . '" disetujui'
            ]);
        }

        return back()->with('success', 'Peminjaman disetujui');
    }

    // Tolak
    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status == 'pending') {

            Notifikasi::create([
                'user_id' => $peminjaman->user_id,
                'pesan' => 'Peminjaman buku "' . $peminjaman->buku->judul_buku . '" ditolak'
            ]);

            $peminjaman->delete();
        }

        return back()->with('success', 'Peminjaman ditolak');
    }

    //  Konfirmasi Pengembalian
    public function confirmKembali($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status == 'menunggu_kembali') {

            $denda = 0;

            if (now()->gt($peminjaman->tanggal_jatuh_tempo)) {
                $telat = now()->diffInDays($peminjaman->tanggal_jatuh_tempo);
                $denda = $telat * 1000;
            }

            $peminjaman->update([
                'status' => 'selesai',
                'tanggal_kembali' => now(),
                'denda' => $denda
            ]);

            $peminjaman->buku->increment('stock_buku');

            Notifikasi::create([
                'user_id' => $peminjaman->user_id,
                'pesan' => 'Buku "' . $peminjaman->buku->judul_buku . '" berhasil dikembalikan'
            ]);
        }

        return back()->with('success', 'Pengembalian dikonfirmasi');
    }
}
