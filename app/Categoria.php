<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {

	protected $table = 'categoria';			//agregamos la tabla al modelo

	protected $primaryKey = 'idcategoria';	//agregamos la llave primaria modelo

	/*
		por defecto se crean dos columnas que permiten que
		especifican cuando han sido creado o actualizado
		un reistro
	*/
	public $timestamps = false;			//activar : true, desactivar:false columnas por defecto

	protected $fillable = [
		'nombre',
		'descripcion',
		'condicion'
	]//campos que recibiran un valor

	protected $guarded = [

	]//cuando no queremos que se asignen al modelo
}
