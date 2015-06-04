<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasyarakatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('masyarakats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('nik');
			$table->string('nama');
			$table->string('jk');
			$table->date('tgl_lahir');
			$table->string('status');
			$table->string('agama');
			$table->string('pekerjaan');
			$table->string('kampung');
			$table->integer('rt');
			$table->integer('rw');
			$table->string('kelurahan');
			$table->string('kecamatan');
			$table->string('kabupaten');
			$table->string('provinsi');
			$table->string('negara');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('masyarakats');
	}

}
