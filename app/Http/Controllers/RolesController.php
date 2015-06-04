<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Entrust\Role;
use Illuminate\Http\Request;

class RolesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::all();

		return $roles;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$role = Role::create([
			'name'	=> $request->name,
			'display_name'	=> $request->display_name,
			'description' => $request->description
			]);
		return $role;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$role = Role::find($id);

		return $role;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$role = Role::find($id);
		$role->name = $request->name;
		$role->display_name = $request->display_name;
		$role->description = $request->description;
		$role->save();

		return $role;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Role::destroy($id);
	}

}
