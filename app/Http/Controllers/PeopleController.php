<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePeople;
use App\Models\Office;
use App\Models\People;
use Exception;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peoples = People::with('office')->paginate(10);
        return view('peoples.index', compact('peoples'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::all();
        return view('peoples.create',  compact('offices'));
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreUpdatePeople $request)
    {
        try {

            $data = $request->all();
            $data['status'] = 1;
            People::query()->create($data);
            return redirect()->route('peoples.view')->with('success', 'Registro salvo com sucesso!');

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
        $people = People::find($id);
        if(!$people){
            return redirect()->route('peoples.view')->with('error', 'Registro não encontrado!');
        }
        $offices = Office::all();
        return view('peoples.edit',  compact('people', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdatePeople $request, string $id)
    {
        try {

            $people = People::find($id);
            $data = $request->all();
            $people->update($data);
            return redirect()->route('peoples.view')->with('success', 'Registro salvo com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $people = People::find($id);

        if (!$people) {
            return redirect()->back()->with('error', 'Pessoa não encontrada.');
        }
        $people->delete();
        return redirect()->route('peoples.view')->with('success', 'Excluído com sucesso!');

    }
}
