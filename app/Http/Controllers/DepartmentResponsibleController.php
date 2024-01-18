<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DepartmentResponsible;
use App\Models\Management;
use App\Models\People;
use App\Models\Sector;
use Exception;
use Illuminate\Http\Request;

class DepartmentResponsibleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departmentsResponsibles = DepartmentResponsible::with('responsible', 'managements', 'sector')->paginate(10);
        return view('department_responsible.index', compact('departmentsResponsibles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $managements = Management::all();
        $responsibles = People::all();
        $departments = Sector::all();
        return view('department_responsible.create',  compact('managements', 'responsibles', 'departments'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $data = $request->all();
            $data['status'] = 1;
       
            DepartmentResponsible::query()->create($data);
            return redirect()->route('departmentsResponsibles.view')->with('success', 'Registro salvo com sucesso!');

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
        $departmentResponsible = DepartmentResponsible::find($id);

        if(!$departmentResponsible){
            return redirect()->route('departmentsResponsibles.view')->with('error', 'Registro não encontrado!');
        }
        $managements = Management::all();
        $responsibles = People::all();
        return view('department_responsible.edit',  compact('departmentResponsible', 'managements', 'responsibles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $departmentResponsible = DepartmentResponsible::find($id);

            if(!$departmentResponsible){
                return redirect()->route('departmentsResponsibles.view')->with('error', 'Registro não encontrado!');
            }

            $data = $request->all();

            $departmentResponsible->update($data);
            return redirect()->route('departmentsResponsibles.view')->with('success', 'Registro salvo com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departmentResponsible = DepartmentResponsible::find($id);

        if (!$departmentResponsible) {
            return redirect()->back()->with('error', 'Registro não encontrado.');
        }
        $departmentResponsible->delete();
        return redirect()->route('departmentsResponsibles.view')->with('success', 'Excluído com sucesso!');

    }
}
