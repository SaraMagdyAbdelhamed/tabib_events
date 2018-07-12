<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamousAttractionCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('famous_attraction_categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('famous_attraction_id')->nullable();
			$table->integer('category_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('famous_attraction_categories');
	}

}
