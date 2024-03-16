<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOrgan;
use App\Models\ManagementUnit;
use App\Models\Organ;
use App\Models\People;
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
        $peoples = People::where('situation_id', 1)->get();
        return view('organs.create', compact('managementUnits', 'peoples'));
    }

    public function store(StoreUpdateOrgan $request)
    {
        try {
            $data = $request->all();
            $data['status'] = 1;
            $data['situation_id'] = 1;
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
        $peoples = People::where('situation_id', 1)->get();
        return view('organs.edit', compact('organ', 'managementUnits', 'peoples'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateOrgan $request, string $id)
    {
        try {
            $organ = Organ::find($id);
            if (!$organ) {
                return redirect()->route('organs.view')->with('error', 'Registro não encontrado!');
            }
           
            $data = $request->all();

            if ($data['people_id'] == null) {
                return redirect()->back()->with('error', 'O responsável é obrigatório!');
            }
           
            if ($data['status'] == 0 && $organ->sector()->count() > 0) {
                return redirect()->back()->with('error', 'Esse registro não pode ser inativado.');
            }

            $organ->update($data);

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
        $organ = Organ::find($id);
     
        if (!$organ) {
            return redirect()->back()->with('error', 'Registro não encontrado.');
        }
        if ($organ->sector()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Esse registro não pode ser excluído pois ele está relacionado com setor.');
        }
        $organ->delete();
        return redirect()->route('sectors.view')->with('success', 'Registro excluído com sucesso!');
    }
}
