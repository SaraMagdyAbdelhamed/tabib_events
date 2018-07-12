<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventPostRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_post_replies', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_post_id')->nullable();
			$table->string('reply')->nullable();
			$table->integer('created_by')->nullable();
			$table->timestamps();
			$table->integer('updated_by')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_post_replies');
	}

}
