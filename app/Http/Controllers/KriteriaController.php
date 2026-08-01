<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KriteriaSaw;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaSaw::all();
        return view('admin.kriteria', compact('kriteria'));
    }

    // Menyimpan perubahan bobot
    public function update(Request $request)
    {
        $semuaKriteria = KriteriaSaw::all();
        
        foreach ($semuaKriteria as $item) {
            // Kita mengambil input dinamis berdasarkan ID masing-masing kriteria
            $inputName = 'bobot_' . $item->id;
            
            if ($request->has($inputName)) {
                $item->update([
                    'bobot' => $request->input($inputName)
                ]);
            }
        }

        return redirect()->back()->with('success', 'Bobot Kriteria berhasil diperbarui!');
    }
}
