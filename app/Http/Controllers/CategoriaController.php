<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Categoria;
use Iluminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;

class CategoriaController extends Controller {

	public function __construct()
	{

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//obtenemos los registros de la tabla categoria
		if($request)
		{
			$query = trim($request -> get('searchText'));//almacena el texto de busqueda
			$categorias = DB::table('categoria') -> where('nombre','LIKE','%'.$query.'%')
			->where('condicion', '=', '1')
			->orderBy('idcategoria', 'desc')
			->paginate(7);//condicion de la busqueda en la tabla categoria

			return view('almacen.categoria.index', ["categorias" => $categorias, "searchText"=>$query]);
		} // si el objeto existe
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view("almacen.categoria,create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CategoriaFormRequest $request)
	{
		//para almacenar nuestro objeto categoria en la tabla categoria de la base de datos
		$categoria = new Categoria;
		$categoria->nombre=$request->get('nombre');
		$categoria->descirpcion=$request->get('descripcion');
		$categoria->condicion='1';
		$categoria->save();
		return Redirect::to('almacen/categoria');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//para mostrar una vista
		return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);//llamame a la vista y enviale esta categoria para que la muestre
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);//llamame a la vista y enviale esta categoria para que la modificarlos
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CategoriaFormRequest $request,$id)
	{
		//almacenamos o que hacemos en edit
		$categoria = Categoria::findOrFail($id);
		$categoria->nombre=$request->get('nombre');
		$categoria->descripcion=$request->get('descripcion');
		$categoria->update();

		return Redirect::to('almacen/categoria');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//ponemos la condicion de la categoria a 0
		$categoria = Categoria::findOrFail($id);
		$categoria->condicion='0';
		$categoria->update();
		return Redirect::to('almacen/categoria');

	}

}
