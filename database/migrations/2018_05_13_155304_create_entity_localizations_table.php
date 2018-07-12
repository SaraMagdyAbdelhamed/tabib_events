<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntityLocalizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entity_localizations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('entity_id')->nullable();
			$table->string('field')->nullable();
			$table->integer('item_id')->nullable();
			$table->text('value')->nullable();
			$table->integer('lang_id')->nullable()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entity_localizations');
	}

}
