<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamousAttractionDaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('famous_attraction_days', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('famous_attraction_id')->nullable();
			$table->string('day_id')->nullable();
			$table->string('from')->nullable();
			$table->string('to')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('famous_attraction_days');
	}

}
