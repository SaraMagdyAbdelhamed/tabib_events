<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('website')->nullable();
			$table->string('mobile')->nullable();
			$table->string('email')->nullable();
			$table->string('code')->nullable();
			$table->string('address')->nullable();
			$table->string('longtuide')->nullable();
			$table->string('latitude')->nullable();
			$table->string('venue')->nullable();
			$table->dateTime('start_datime')->nullable();
			$table->dateTime('end_datetime')->nullable();
			$table->boolean('suggest_big_event')->nullable();
			$table->integer('gender_id')->nullable();
			$table->integer('age_range_id')->nullable();
			$table->boolean('is_paid')->nullable();
			$table->boolean('use_ticketing_system')->nullable();
			$table->boolean('is_active')->nullable();
			$table->integer('event_status_id')->nullable();
			$table->string('rejection_reason')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}
