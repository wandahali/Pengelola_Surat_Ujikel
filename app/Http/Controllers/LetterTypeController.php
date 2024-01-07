<?php

namespace App\Http\Controllers;

use App\Models\letter_type;
use Illuminate\Http\Request;
use Excel;
use App\Exports\ExportLetter;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = letter_type::all();
        return view('letype.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('letype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'letter_code' => 'required|max:7',
            'name_type' => 'required|min:3'
        ]);
    
        $letter = Letter_type::create([
            'letter_code' => $request->letter_code,
            'name_type' => $request->name_type
        ]);
    
        if ($letter) {
            $kodeSurat = $request->letter_code . "-" . $letter->id;
    
            $letter->update(['letter_code' => $kodeSurat]);
    
            return redirect()->route('letype.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('letype.index')->with('error', 'Data tidak dapat ditambahkan. Terjadi kesalahan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(letter_type $letter_type)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $types = letter_type::find($id);
        return view('letype.edit',compact('types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_type' => 'required|min:4',
        ]);

        $existingCount = letter_type::where('id', $id)->value('letter_code');

        preg_match('/-(\d+)$/', $existingCount, $matches);

        if(!empty($matches[1])){
            $numericPart = $matches[1];
        }else{
            $numericPart = 0;
        }
        $letterCode = $request->letter_code . '-' . $numericPart;

    letter_type::where('id', $id)->update([
        'letter_code' => $letterCode,
        'name_type'=> $request->name_type,
    ]);
        return redirect()->route('letype.index')->with('success', 'Berhasil mengubah data !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        letter_type::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil Menghapus data');
    }

    public function exportExcel()
    {
        $file_name = 'data_klasifikasi'.'.xlsx';
        return Excel::download(new ExportLetter, $file_name);
    }

}
