<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
	}

}

/**
* Menambahkan User Kedalam Database
*/
class UserTableSeeder extends Seeder
{

	function run()
	{
		$user = User::create([
			'name'	=> 'Nurul Imam',
			'email'	=> 'admin@bits.co.id',
			'password' => Hash::make('password'),
			]);
	}
}