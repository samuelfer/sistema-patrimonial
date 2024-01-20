<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateManagementUnitResponsible;
use App\Models\ManagementUnit;
use App\Models\ManagementUnitResponsible;
use App\Models\People;
use App\Models\Situation;
use Exception;

class ManagementUnitResponsibleController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managementUnitsResponsible = ManagementUnitResponsible::orderBy('management_unit_id')->get();
        return view('management_units_responsible.index', compact('managementUnitsResponsible'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peoples = People::all();
        $managementUnits = ManagementUnit::all();
        return view('management_units_responsible.create', compact('peoples', 'managementUnits'));
    }

    public function store(StoreUpdateManagementUnitResponsible $request)
    {
        try {
            $data = $request->all();

            $data['situation_id'] = 1;
            ManagementUnitResponsible::create($data);
            return redirect()->route('management_units_responsible.view')->with('success', 'Registro salvo com sucesso!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar cadastrar!'.$e);
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
        $managementUnitResponsible = ManagementUnitResponsible::find($id);
        if (!$managementUnitResponsible) {
            return redirect()->route('management_units_responsible.view')->with('error', 'Registro não encontrado!');
        }
        $peoples = People::all();
        $managementUnits = ManagementUnit::all();
        $situations = Situation::all();
        return view('management_units_responsible.edit', compact('managementUnitResponsible', 'peoples', 'managementUnits', 'situations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateManagementUnitResponsible $request, string $id)
    {
        try {            
            $managementUnitResponsible = ManagementUnitResponsible::find($id);
            $data = $request->all();

            $managementUnitResponsible->update($data);

            return redirect()->route('management_units_responsible.view')->with('success', 'Registro salvo com sucesso!');
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $managementUnitResponsible = ManagementUnitResponsible::find($id);
     
        if (!$managementUnitResponsible) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar excluir o registro.');
        }

        $managementUnitResponsible->delete();
        return redirect()->route('management_units_responsible.view')->with('success', 'Registro excluído com sucesso!');
    }
}
