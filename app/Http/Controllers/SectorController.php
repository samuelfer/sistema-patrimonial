<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSector;
use App\Models\ManagementUnit;
use App\Models\Sector;
use Exception;
use Illuminate\Support\Facades\Auth;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors = Sector::with('managementUnit')->paginate(10);
        return view('sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $managementUnits = ManagementUnit::all();
        return view('sectors.create', compact('managementUnits'));
    }

    public function store(StoreUpdateSector $request)
    {
        try {
            $data = $request->all();
            Sector::create($data);
            return redirect()->route('sectors.view')->with('success', 'Registro salvo com sucesso!');

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
        if (!Auth::user()->is_admin) {
            return redirect()->route('sectors.view')->with('error', 'O usuário logado não pode editar unidade gestora!');
        }

        $sector = Sector::find($id);
        if (!$sector) {
            return redirect()->route('sectors.view')->with('error', 'Registro não encontrado!');
        }
        $managementUnits = ManagementUnit::all();
        return view('sectors.edit', compact('sector', 'managementUnits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSector $request, string $id)
    {
        try {
            if (!Auth::user()->is_admin) {
                return redirect()->route('sectors.view')->with('error', 'O usuário logado não pode editar unidade gestora!');
            }
            
            $sector = Sector::find($id);
            $data = $request->all();

            $sector->update($data);

            return redirect()->route('sectors.view')->with('success', 'Registro salvo com sucesso!');
            
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
            return redirect()->route('sectors.view')->with('error', 'O usuário logado não pode excluir permissões!');
        }

        $sector = Sector::find($id);
     
        if (!$sector) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar excluir o registro.');
        }

        $sector->delete();
        return redirect()->route('sectors.view')->with('success', 'Registro excluído com sucesso!');
    }
}
