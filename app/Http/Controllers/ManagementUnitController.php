<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateManagementUnit;
use App\Models\ManagementUnit;
use App\Models\People;
use Exception;
use Illuminate\Support\Facades\Auth;

class ManagementUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = ManagementUnit::orderBy('name')->get();
        return view('management_units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peoples = People::where('status', 1)->get();
        return view('management_units.create', compact('peoples'));
    }

    public function store(StoreUpdateManagementUnit $request)
    {
        try {
            $data = $request->all();
            $data['status'] = 1;
            ManagementUnit::create($data);
            return redirect()->route('management_units.view')->with('success', 'Registro salvo com sucesso!');

        } catch (Exception $e) {
            dd($e);
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
            return redirect()->route('management_units.view')->with('error', 'O usuário logado não pode editar unidade gestora!');
        }

        $unit = ManagementUnit::find($id);
       
        if (!$unit) {
            return redirect()->route('management_units.view')->with('error', 'Registro não encontrado!');
        }
        $peoples = People::where('status', 1)->get();
        return view('management_units.edit', compact('unit', 'peoples'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateManagementUnit $request, string $id)
    {
        try {
            if (!Auth::user()->is_admin) {
                return redirect()->route('management_units.view')->with('error', 'O usuário logado não pode editar unidade gestora!');
            }
            
            $unit = ManagementUnit::find($id);
            $data = $request->all();

            if ($data['people_id'] == null) {
                return redirect()->back()->with('error', 'O responsável é obrigatório!');
            }

            $unit->update($data);

            return redirect()->route('management_units.view')->with('success', 'Registro salvo com sucesso!');
            
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
            return redirect()->route('management_units.view')->with('error', 'O usuário logado não pode excluir unidade gestora!');
        }

        $unit = ManagementUnit::find($id);
     
        if (!$unit) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar excluir o registro.');
        }

        $unit->delete();
        return redirect()->route('management_units.view')->with('success', 'Registro excluído com sucesso!');
    }
}
