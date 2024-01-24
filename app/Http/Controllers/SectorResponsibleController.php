<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateSectorResponsible;
use App\Models\People;
use App\Models\Sector;
use App\Models\SectorResponsible;
use App\Models\Situation;
use Exception;
use Illuminate\Http\Request;

class SectorResponsibleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectorsResponsibles=SectorResponsible::orderBy('sector_id')->get();

        return view('sectors_responsible.index', compact('sectorsResponsibles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $peoples= People::all();
        $sectors= Sector::all();

        return view('sectors_responsible.create', compact('peoples', 'sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSectorResponsible $request)
    {
        try {

            $data = $request->all();
            $data['situation_id'] = 1;
          //  dd($data);
            SectorResponsible::create($data);
            return redirect()->route('sector_responsible.view')->with('success', 'Registro salvo com sucesso!');

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
        $sectorResponsible=SectorResponsible::find($id);
        if (!$sectorResponsible) {
            return redirect()->route('sector_responsible.view')->with('error', 'Registro não encontrado!');
        }
        $peoples = People::all();
        $sectors= Sector::all();
        $situations=Situation::all();

        return  view('sectors_responsible.edit',
                compact('sectorResponsible', 'sectorResponsible', 'peoples', 'sectors', 'situations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSectorResponsible $request, string $id)
    {
            try {
                $sectorResponsible=SectorResponsible::find($id);
                $data = $request->all();

                $sectorResponsible->update($data);

                return redirect()->route('sector_responsible.view')->with('success', 'Registro salvo com sucesso!');
            } catch (Exception $e) {
                dd($e);
                return redirect()->back()->with('error', 'Erro ao tentar salvar!');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sectorResponsible=SectorResponsible::find($id);
        if(!$sectorResponsible){
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar excluir o registro.');
        }
        $sectorResponsible->delete();
        return redirect()->route('sector_responsible.view')->with('success', 'Registro excluído com sucesso!');
    }
}
