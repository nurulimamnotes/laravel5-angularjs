<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinsisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("provinsis", function(Blueprint $table){
			$table->increments('kd_prov');
			$table->string('provinsi');
			$table->integer('kd_negara')->unsigned();
			$table->timestamps();
			
            $table->foreign('kd_negara')->references('kd_negara')->on('negaras')
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
		Schema::drop("provinsis");
	}

}
