<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrenciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('currencies', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 100)->default('');
			$table->string('symbol', 20)->default('');
			$table->float('rate', 11, 6)->nullable();
			$table->integer('def')->nullable()->default(0);
			$table->string('subdivision_name', 100)->nullable();
			$table->integer('sort_order')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('currencies');
	}

}
