<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_tickets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id')->nullable();
			$table->string('name')->nullable();
			$table->decimal('price', 10)->nullable();
			$table->integer('available_tickets')->nullable();
			$table->integer('current_available_tickets')->nullable();
			$table->integer('currency_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_tickets');
	}

}
