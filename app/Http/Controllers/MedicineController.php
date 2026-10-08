<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    use AuthorizesRequests;
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

    public function store(StoreMedicineRequest $request)
    {
    $validated = $request->validated();

    Auth::user()->medicines()->create($validated);

    return redirect()->route('medicines.index')->with('success', 'Medicamento cadastrado com sucesso!');
    }

    public function edit(Medicine $medicine)
    {
        $this->authorize('update', $medicine);

        return view('medicines.edit', compact('medicine'));
    }

    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $this->authorize('update', $medicine);

        $validated = $request->validated();

        $medicine->update($validated);

        return redirect()->route('medicines.index')->with('success', 'Medicamento atualizado com sucesso!');
    }

    public function destroy(Medicine $medicine)
    {
        $this->authorize('delete', $medicine);

        $medicine->delete();

        return redirect()->route('medicines.index')->with('success', 'Medicamento excluído com sucesso!');
    }
}
