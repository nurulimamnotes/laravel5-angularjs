<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKecamatansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("kecamatans", function(Blueprint $table){
			$table->increments('kd_kec');
			$table->string('kecamatan');
			$table->integer('kd_kab')->unsigned();
			$table->timestamps();

            $table->foreign('kd_kab')->references('kd_kab')->on('kabupatens')
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
		Schema::drop("kecamatans");
	}

}
