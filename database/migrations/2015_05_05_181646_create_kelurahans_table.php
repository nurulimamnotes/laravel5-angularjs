<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelurahansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("kelurahans", function(Blueprint $table){
			$table->increments('kd_kelurahan');
			$table->string('kelurahan');
			$table->integer('kd_kec')->unsigned();
			$table->timestamps();

            $table->foreign('kd_kec')->references('kd_kec')->on('kecamatans')
                ->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("kelurahans");
	}

}
