<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateOrganResponsible;
use App\Models\Organ;
use App\Models\OrganResponsible;
use App\Models\People;
use App\Models\Situation;
use Exception;
use Illuminate\Http\Request;

class OrganResponsibleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organsResponsible=OrganResponsible::orderBy('organ_id')->get();
        return view('organs_responsible.index', compact('organsResponsible'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peoples=People::all();
        $organs=Organ::all();
        return view('organs_responsible.create', compact('peoples', 'organs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateOrganResponsible $request)
    {
        try {
            $data = $request->all();
            $data['situation_id'] = 1;
            OrganResponsible::create($data);
            return redirect()->route('organ_responsible.view')->with('success', 'Registro salvo com sucesso!');

        } catch (Exception $e) {
            dd($e);
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
        $organResponsible = OrganResponsible::find($id);
        if (!$organResponsible) {
            return redirect()->route('organ_responsible.view')->with('error', 'Registro não encontrado!');
        }
        $peoples=People::all();
        $organs=Organ::all();
        $situations=Situation::all();
        return view('organs_responsible.edit', compact('organResponsible', 'peoples', 'organs', 'situations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateOrganResponsible $request, string $id)
    {
        try {
            $organResponsible=OrganResponsible::find($id);
            $data=$request->all();

            $organResponsible->update($data);

            return redirect()->route('organ_responsible.view')->with('success', 'Registro salvo com sucesso!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $organResponsible = OrganResponsible::find($id);

        if (!$organResponsible) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar excluir o registro.');
        }

        $organResponsible->delete();
        return redirect()->route('organ_responsible.view')->with('success', 'Registro excluído com sucesso!');


    }
}
