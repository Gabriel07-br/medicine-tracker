<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    /**
     * Exibe a listagem de medicamentos.
     * 
     * Auth::user()->medicines utiliza o relacionamento 'hasMany' para buscar 
     * APENAS os registros vinculados ao ID do usuário autenticado no banco.
     * 
     * compact('medicines') envia a coleção para a view 'medicines/index.blade.php'.
     */
    public function index()
    {
        $medicines = Medicine::where('user_id', Auth::id())->get();
        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'dosage' => 'required|string|max:255',
        'frequency' => 'required|string|max:255',
    ]);

    Auth::user()->medicines()->create($validated);

    return redirect()->route('medicines.index')->with('success', 'Medicamento cadastrado com sucesso!');
    }
}
