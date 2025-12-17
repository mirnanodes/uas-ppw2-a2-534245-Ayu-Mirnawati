<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * PegawaiController - Mirna
 */
class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $data = Pegawai::with('pekerjaan')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            })
            ->paginate(10)->withQueryString(); // Pagination - Mirna

        return view('pegawai.index', compact('data'));
    }

    public function add()
    {
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.add', compact('pekerjaan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email',
            'gender' => 'required|in:male,female',
            'pekerjaan_id' => 'required|exists:pekerjaan,id',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pegawai::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'gender' => $request->gender,
            'pekerjaan_id' => $request->pekerjaan_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Pegawai::findOrFail($id);
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.edit', compact('data', 'pekerjaan'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email,' . $request->id,
            'gender' => 'required|in:male,female',
            'pekerjaan_id' => 'required|exists:pekerjaan,id',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = Pegawai::findOrFail($request->id);
        $data->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'gender' => $request->gender,
            'pekerjaan_id' => $request->pekerjaan_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        Pegawai::findOrFail($request->id)->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }
}
