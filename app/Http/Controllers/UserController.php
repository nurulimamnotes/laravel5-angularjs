<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Entrust\Role;
use App\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		
		foreach ($users as $user) {
			foreach ($user->roles as $role) {
			}
		}

		return $users;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function paginate()
	{
		$users = User::paginate(5);
		
		foreach ($users as $user) {
			foreach ($user->roles as $role) {
			}
		}

		return $users;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user = User::create([
			'name'	=> $request->name,
			'email'	=> $request->email,
			'password' => Hash::make($request->password),
			]);
		return $user;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);

		return $user;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$user = User::find($id);
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->save();

		return $user;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);
	}

}
