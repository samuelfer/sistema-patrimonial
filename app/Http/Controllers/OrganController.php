<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOrgan;
use App\Models\ManagementUnit;
use App\Models\Organ;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organs = Organ::with('managementUnit')->paginate(10);
        return view('organs.index', compact('organs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $managementUnits = ManagementUnit::all();
        return view('organs.create', compact('managementUnits'));
    }

    public function store(StoreUpdateOrgan $request)
    {
        try {
            $data = $request->all();
            Organ::create($data);
            return redirect()->route('organs.view')->with('success', 'Registro salvo com sucesso!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar cadastrar!'.$e->getMessage());
        }
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organ = Organ::find($id);
        if (!$organ) {
            return redirect()->route('organs.view')->with('error', 'Registro não encontrado!');
        }
        $managementUnits = ManagementUnit::all();
        return view('organs.edit', compact('organ', 'managementUnits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateOrgan $request, string $id)
    {
        try {
            $sector = Organ::find($id);
            $data = $request->all();

            $sector->update($data);

            return redirect()->route('organs.view')->with('success', 'Registro salvo com sucesso!');
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('sectors.view')->with('error', 'O usuário logado não pode excluir órgãos!');
        }

        $organ = Organ::find($id);
     
        if (!$organ) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar excluir o registro.');
        }

        $organ->delete();
        return redirect()->route('sectors.view')->with('success', 'Registro excluído com sucesso!');
    }
}
