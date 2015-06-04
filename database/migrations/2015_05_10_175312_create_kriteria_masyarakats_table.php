<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKriteriaMasyarakatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("kriteria_masyarakats", function(Blueprint $table){
			$table->integer('id_mas')->unsigned();
			$table->integer('id_kriteria')->unsigned();
			$table->integer('nilai');
			$table->timestamps();

            $table->foreign('id_mas')->references('id')->on('masyarakats')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_kriteria')->references('id')->on('kriterias')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['id_mas', 'id_kriteria']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("kriteria_masyarakats");
	}

}
