<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateManagement;
use App\Models\Management;
use Exception;

class ManagementController extends Controller
{
    public function index()
    {
        $managements = Management::all();
        return view('managements.index', compact('managements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('managements.create');
    }

    public function store(StoreUpdateManagement $request)
    {
        try {
            $data = $request->all();

            $data['start'] = $this->checkValidateDate($data['start']);
            $data['end'] = $this->checkValidateDate($data['end']);
            if ( $data['start'] == null ||  $data['start'] == null) {
                return redirect()->back()->with('error', 'Por favor, verifique as datas informadas!');
            }

            if ($this->isAllReadyRegistered($data['start'], $data['end']) > 0) 
            {
                return redirect()->back()->with('error', 'Gestão já cadastrada!');
            }
           
            $data['status'] = 1;
            Management::create($data);
            return redirect()->route('managements.view')->with('success', 'Registro salvo com sucesso!');

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
        $management = Management::find($id);
        if (!$management) {
            return redirect()->route('managements.view')->with('error', 'Registro não encontrado!');
        }
        return view('managements.edit', compact('management'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateManagement $request, string $id)
    {
        try {
           
            $management = Management::find($id);
            $data = $request->all();

            $data['start'] = \Carbon\Carbon::parse( $data['start'])->format('Y-m-d');
            $data['end'] = \Carbon\Carbon::parse( $data['end'])->format('Y-m-d');
            $management->update($data);

            return redirect()->route('managements.view')->with('success', 'Registro salvo com sucesso!');
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $management = Management::find($id);
     
        if (!$management) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar excluir o registro.');
        }

        $management->delete();
        return redirect()->route('managements.view')->with('success', 'Registro excluído com sucesso!');
    }

    private function checkValidateDate($date) {
        $tempDate = explode('/', $date);
        if (checkdate($tempDate[1], $tempDate[0], $tempDate[2])) {
            return "{$tempDate[2]}" . "-" . "{$tempDate[1]}" . "-" . "{$tempDate[0]}";
        }
        return null;
    }

    private function isAllReadyRegistered($dateStart, $dateEnd) 
    {
        return Management::where('start', $dateStart)
        ->orWhere('end', $dateEnd)->count();
    }
}