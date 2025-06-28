<?php
namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function index()
    {
        $pesans = Pesan::where('penerima_id', auth()->id())->latest()->get();
        
        return view('pesan.index', compact('pesans', ));
    }

    public function kirimPesan(Request $request)
    {
        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        $penulis = User::where('role', 'penulis')->get();
        foreach ($penulis as $user) {
            Pesan::create([
                'pengirim_id' => auth()->id(),
                'penerima_id' => $user->id,
                'isi' => $request->isi,
            ]);
        }

        return back()->with('success', 'Pesan berhasil dikirim ke semua penulis.');
    }
    public function riwayat()
        {
            // Hanya tampilkan pesan yang dikirim oleh admin yang sedang login
            $pesans = Pesan::with('penerima')
                ->where('pengirim_id', auth()->id())
                ->latest()
                ->get();

            return view('pesan.adminpesan', compact('pesans'));
        }
        
   public function hapus($id)
        {
            $pesan = Pesan::findOrFail($id);
            if ($pesan->penerima_id == auth()->id()) {
                $pesan->delete();
                return back()->with('success', 'Pesan berhasil dihapus.');
            }

            abort(403);
        }
}
