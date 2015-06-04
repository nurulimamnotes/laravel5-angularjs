<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKabupatensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("kabupatens", function(Blueprint $table){
			$table->increments('kd_kab');
			$table->string('kabupaten');
			$table->integer('kd_prov')->unsigned();
			$table->timestamps();
			
            $table->foreign('kd_prov')->references('kd_prov')->on('provinsis')
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
		Schema::drop("kabupatens");
	}

}
