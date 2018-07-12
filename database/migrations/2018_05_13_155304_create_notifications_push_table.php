<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsPushTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications_push', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('notification_id')->nullable();
			$table->string('device_token')->nullable();
			$table->string('mobile_os')->nullable();
			$table->boolean('lang_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifications_push');
	}

}
