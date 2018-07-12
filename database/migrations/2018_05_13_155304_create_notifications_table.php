<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('msg')->nullable();
			$table->integer('entity_id')->nullable();
			$table->integer('item_id')->nullable();
			$table->integer('notification_type_id')->nullable();
			$table->boolean('is_read')->nullable();
			$table->boolean('is_sent')->nullable();
			$table->dateTime('created_at')->nullable();
			$table->dateTime('schedule')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifications');
	}

}
