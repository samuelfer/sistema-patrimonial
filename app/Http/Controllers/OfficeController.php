<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreUpdateOffice;
use App\Models\ManagementUnit;
use App\Models\Office;
use Exception;

class OfficeController extends Controller
{
    public function index(Request $request)
    {
        $offices = $this->filtro($request);
        return view('offices.index', ['offices' => $offices, 'name' => $request->name, 
                                                'startDate' => $request->start_date, 'endDate' => $request->end_date]);
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

    public function gerarPdf(Request $request)
    {
        $offices = $this->filtro($request);
        // Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo
        $pdf = PDF::loadView('offices.gerar-pdf', ['offices' => $offices])->setPaper('a4', 'portrait');

        // Fazer o download do arquivo
        return $pdf->download('cargos_e_funcoes.pdf');
        
    }

    private function filtro(Request $request) 
    {
        $offices = Office::when($request->has('name'), function ($whenQuery) use ($request){
            $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })
        ->when($request->filled('start_data'), function ($whenQuery) use ($request){
            $whenQuery->where('start_data', '>=', \Carbon\Carbon::parse($request->start_data)->format('Y-m-d'));
        })
        ->when($request->filled('end_date'), function ($whenQuery) use ($request){
            $whenQuery->where('end_date', '<=', \Carbon\Carbon::parse($request->end_date)->format('Y-m-d'));
        })
        ->orderByDesc('name')
        ->get();
        return $offices;
    }
}