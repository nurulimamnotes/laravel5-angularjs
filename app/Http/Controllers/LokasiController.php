<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Negara;
use Illuminate\Http\Request;

class LokasiController extends Controller {
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexNegara()
	{
		$negara = Negara::all();

		return $negara;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function tambahNegara()
	{
		return view('lokasi.negara.tambah');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function kelolaNegara($id = null)
	{
		$kd_negara = $id ? Negara::find($id) : new Negara();
		if ($kd_negara) {
			return $this->showLayout($kd_negara);
		} else {
			abort(404);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function simpanNegara()
	{
		$kd_negara = \Request::input('kd_negara');
		$negara = $kd_negara ? Negara::find($kd_negara) : new Negara();
		if ($negara) {
			try {
				$negara->store(Request::all());
				return \Redirect::to('lokasi/negara/edit'.$negara->kd_negara.'?berhasil=1');
			} catch (\Exception $e) {
				return showLayout($negara, $negara->ket_error);
			}
		} else {
			abort(404);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function hapusNegara($id)
	{
		$kd_negara = Request::input('kd_negara');
		$negara = Negara::find($id);
		if ($negara) {
			$negara->delete();
		}
	}

	protected function showLayout(Negara $negara, $errors = array())
	{
		$view = view('lokasi.negara.kelola', array('negara' => $negara, 'success' => \Request::input('berhasil', 0)));
		if (count($errors)) {
		  $view->with('errors', $errors);
		}
		return $view;
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
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
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

}
