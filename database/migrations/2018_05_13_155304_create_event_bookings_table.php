<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventBookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_bookings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id')->nullable();
			$table->integer('event_ticket_id')->nullable();
			$table->string('name')->nullable();
			$table->integer('number_of_tickets')->nullable();
			$table->dateTime('created_at')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('user_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_bookings');
	}

}
