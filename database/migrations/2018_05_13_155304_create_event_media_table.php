<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_media', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id')->nullable();
			$table->string('link')->nullable();
			$table->boolean('type')->nullable()->comment('type 1 => file - type 2 => video ');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_media');
	}

}
