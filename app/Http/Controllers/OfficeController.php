<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOffice;
use App\Models\ManagementUnit;
use App\Models\Office;
use Exception;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::all();
        return view('offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->is_admin) {
            $managementUnits = ManagementUnit::all();
            return view('offices.create', compact('managementUnits'));
        }
        return view('offices.create');
    }

    public function store(StoreUpdateOffice $request)
    {
        try {
            $data = $request->all();
            $data['status'] = 1;
            Office::create($data);
            return redirect()->route('offices.view')->with('success', 'Registro salvo com sucesso!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar cadastrar!');
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
        $office = Office::find($id);
        if (!$office) {
            return redirect()->route('offices.view')->with('error', 'Registro não encontrado!');
        }
        if (auth()->user()->is_admin) {
            $managementUnits = ManagementUnit::all();
            return view('offices.create', compact('office', 'managementUnits'));
        }
        return view('offices.edit', compact('office'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateOffice $request, string $id)
    {
        try {
           
            $office = Office::find($id);
            $data = $request->all();

            $office->update($data);

            return redirect()->route('offices.view')->with('success', 'Registro salvo com sucesso!');
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $office = Office::find($id);
     
        if (!$office) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar excluir o registro.');
        }

        $office->delete();
        return redirect()->route('offices.view')->with('success', 'Registro excluído com sucesso!');
    }
}