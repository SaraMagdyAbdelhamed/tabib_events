<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamousAttractionMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('famous_attraction_media', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('famous_attraction_id')->nullable();
			$table->string('media')->nullable();
			$table->string('type')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('famous_attraction_media');
	}

}
