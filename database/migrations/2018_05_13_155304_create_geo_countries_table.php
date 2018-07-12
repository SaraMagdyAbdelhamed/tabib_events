<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeoCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geo_countries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->string('iso_code', 44)->nullable();
			$table->string('iso_code_alpha3', 3)->nullable();
			$table->string('tele_code', 20)->nullable();
			$table->string('timezone')->nullable();
			$table->integer('continent_id')->nullable();
			$table->integer('application_id')->nullable();
			$table->boolean('is_default')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('geo_countries');
	}

}
