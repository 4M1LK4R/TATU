<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Custom Routes

//Catalogos
//Route::resource('Catalogos', 'CatalogoController');
Route::get('/DataTableCatalogos', 'CatalogoController@datatable')->name('Catalogos.DataTable');
Route::post('/Catalogos/Create', 'CatalogoController@create')->name('Catalogos.Create');
Route::get('/Catalogos/Get', 'CatalogoController@get')->name('Catalogos.Get');
Route::post('/Catalogos/Update', 'CatalogoController@update')->name('Catalogos.Update');
Route::delete('/Catalogos/Delete', 'CatalogoController@delete')->name('Catalogos.Delete');
Route::get('/Catalogos/ListQuery', 'CatalogoController@list_query')->name('Catalogos.ListQuery');

//Vistas tipos catalogos
Route::get('/tipos-establecimientos','CatalogoController@tipos_establecimientos')->name('tipos-establecimientos');
Route::get('/paises','CatalogoController@paises')->name('paises');
Route::get('/tipos-documentos','CatalogoController@tipos_documentos')->name('tipos-documentos');
Route::get('/profesiones','CatalogoController@profesiones')->name('profesiones');
Route::get('/nacionalidades','CatalogoController@nacionalidades')->name('nacionalidades');

//Establecimientos
Route::get('/Establecimientos','EstablecimientoController@index')->name('establecimientos');
Route::get('/DataTableEstablecimientos', 'EstablecimientoController@datatable')->name('Establecimientos.DataTable');
Route::post('/Establecimientos/Create', 'EstablecimientoController@create')->name('Establecimientos.Create');
Route::get('/Establecimientos/Get', 'EstablecimientoController@get')->name('Establecimientos.Get');
Route::post('/Establecimientos/Update', 'EstablecimientoController@update')->name('Establecimientos.Update');
Route::delete('/Establecimientos/Delete', 'EstablecimientoController@delete')->name('Establecimientos.Delete');

//Usuarios
Route::get('/Usuarios','UsuarioController@index')->name('usuarios');
Route::get('/DataTableUsuarios', 'UsuarioController@datatable')->name('Usuarios.DataTable');
Route::post('/Usuarios/Create', 'UsuarioController@create')->name('Usuarios.Create');
Route::get('/Usuarios/Get', 'UsuarioController@get')->name('Usuarios.Get');
Route::post('/Usuarios/Update', 'UsuarioController@update')->name('Usuarios.Update');
Route::delete('/Usuarios/Delete', 'UsuarioController@delete')->name('Usuarios.Delete');
Route::get('/Usuarios/ListQuery', 'UsuarioController@list_query')->name('Usuarios.ListQuery');

//Usuarios Establecimientos
Route::get('/Usuario_Establecimiento','UsuarioEstablecimientoController@index')->name('usuario_establecimiento');
Route::get('/DataTableUsuariosEstablecimientos', 'UsuarioEstablecimientoController@datatable')->name('UsuariosEstablecimientos.DataTable');
Route::post('/Usuario_Establecimiento/Create', 'UsuarioEstablecimientoController@create')->name('UsuariosEstablecimientos.Create');
Route::get('/Usuario_Establecimiento/Get', 'UsuarioEstablecimientoController@get')->name('UsuariosEstablecimientos.Get');
Route::post('/Usuario_Establecimiento/Update', 'UsuarioEstablecimientoController@update')->name('UsuariosEstablecimientos.Update');
Route::delete('/Usuario_Establecimiento/Delete', 'UsuarioEstablecimientoController@delete')->name('UsuariosEstablecimientos.Delete');
//Rutas de Testeo

