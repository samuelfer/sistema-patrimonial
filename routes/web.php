<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::prefix('admin.')->middleware(['access.control.list'])->group(function () {
//     Route::resource('/users', App\Http\Controllers\UserController::class);
// });

 Route::middleware(['auth', 'access.control.list'])->group(function(){

    ############## PERMISSOES ###############
    Route::get('/permissoes', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.view');
    Route::get('/permissoes/cadastro', [App\Http\Controllers\Admin\PermissionController::class, 'create'])->name('permissions.create');
    Route::get('/permissoes/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissoes', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/permissoes/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissoes/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('permissions.destroy');


    ############## PERFIS (ROLES) ###############
    Route::get('/perfis', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.view');
    Route::get('/perfis/cadastro', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
    Route::get('/perfis/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/perfis', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
    Route::put('/perfis/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
    Route::delete('/perfis/{id}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.destroy');

    ############## USUARIOS ###############
    Route::get('/usuarios', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.view');
    Route::get('/usuarios/cadastro', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::get('/usuarios/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::post('/usuarios', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::put('/usuarios/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/usuarios/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/meu-perfil/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');


    Route::post('/users.save-image', [App\Http\Controllers\Admin\UserController::class, 'saveImage'])->name('users.save-image');


   ############## USUARIOS ###############
   Route::get('/alterar-senha', [App\Http\Controllers\Admin\AlterPasswordController::class, 'index'])->name('password.index');
   Route::post('/alterar-senha', [App\Http\Controllers\Admin\AlterPasswordController::class, 'store'])->name('password.store');

   ############## AUDITORIA ###############
   Route::get('/auditoria', [App\Http\Controllers\Admin\AcitivityLogController::class, 'index'])->name('logs.view');


   ############## UNIDADE GESTORA ###############
   Route::get('/unidade-gestora', [App\Http\Controllers\ManagementUnitController::class, 'index'])->name('management_units.view');
   Route::get('/unidade-gestora/cadastro', [App\Http\Controllers\ManagementUnitController::class, 'create'])->name('management_units.create');
   Route::get('/unidade-gestora/{id}', [App\Http\Controllers\ManagementUnitController::class, 'edit'])->name('management_units.edit');
   Route::post('/unidade-gestora', [App\Http\Controllers\ManagementUnitController::class, 'store'])->name('management_units.store');
   Route::put('/unidade-gestora/{id}', [App\Http\Controllers\ManagementUnitController::class, 'update'])->name('management_units.update');
   Route::delete('/unidade-gestora/{id}', [App\Http\Controllers\ManagementUnitController::class, 'destroy'])->name('management_units.destroy');

   ############## ORGAO ###############
   Route::get('/orgaos', [App\Http\Controllers\OrganController::class, 'index'])->name('organs.view');
   Route::get('/orgaos/cadastro', [App\Http\Controllers\OrganController::class, 'create'])->name('organs.create');
   Route::get('/orgaos/{id}', [App\Http\Controllers\OrganController::class, 'edit'])->name('organs.edit');
   Route::post('/orgaos', [App\Http\Controllers\OrganController::class, 'store'])->name('organs.store');
   Route::put('/orgaos/{id}', [App\Http\Controllers\OrganController::class, 'update'])->name('organs.update');
   Route::delete('/orgaos/{id}', [App\Http\Controllers\OrganController::class, 'destroy'])->name('organs.destroy');


   ############## SETOR ###############
   Route::get('/setores', [App\Http\Controllers\SectorController::class, 'index'])->name('sectors.view');
   Route::get('/setores/cadastro', [App\Http\Controllers\SectorController::class, 'create'])->name('sectors.create');
   Route::get('/setores/{id}', [App\Http\Controllers\SectorController::class, 'edit'])->name('sectors.edit');
   Route::post('/setores', [App\Http\Controllers\SectorController::class, 'store'])->name('sectors.store');
   Route::put('/setores/{id}', [App\Http\Controllers\SectorController::class, 'update'])->name('sectors.update');
   Route::delete('/setores/{id}', [App\Http\Controllers\SectorController::class, 'destroy'])->name('sectors.destroy');

   ############## CARGO E FUNCAO ###############
   Route::get('/cargos', [App\Http\Controllers\OfficeController::class, 'index'])->name('offices.view');
   Route::get('/cargos/cadastro', [App\Http\Controllers\OfficeController::class, 'create'])->name('offices.create');
   Route::get('/cargos/{id}', [App\Http\Controllers\OfficeController::class, 'edit'])->name('offices.edit');
   Route::post('/cargos', [App\Http\Controllers\OfficeController::class, 'store'])->name('offices.store');
   Route::put('/cargos/{id}', [App\Http\Controllers\OfficeController::class, 'update'])->name('offices.update');
   Route::delete('/cargos/{id}', [App\Http\Controllers\OfficeController::class, 'destroy'])->name('offices.destroy');

   ############## PESSOAS ###############
   Route::get('/peoples', [App\Http\Controllers\PeopleController::class, 'index'])->name('peoples.view');
   Route::get('/peoples/cadastro', [App\Http\Controllers\PeopleController::class, 'create'])->name('peoples.create');
   Route::get('/peoples/{id}', [App\Http\Controllers\PeopleController::class, 'edit'])->name('peoples.edit');
   Route::post('/peoples', [App\Http\Controllers\PeopleController::class, 'store'])->name('peoples.store');
   Route::put('/peoples/{id}', [App\Http\Controllers\PeopleController::class, 'update'])->name('peoples.update');
   Route::delete('/peoples/{id}', [App\Http\Controllers\PeopleController::class, 'destroy'])->name('peoples.destroy');

});

