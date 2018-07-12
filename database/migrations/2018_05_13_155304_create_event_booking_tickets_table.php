<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventBookingTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_booking_tickets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id')->nullable();
			$table->integer('booking_id')->nullable();
			$table->string('barcode')->nullable();
			$table->string('serial_number', 11)->nullable();
			$table->boolean('is_used')->nullable();
			$table->string('pdf')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_booking_tickets');
	}

}
