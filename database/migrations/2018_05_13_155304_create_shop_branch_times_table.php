<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopBranchTimesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop_branch_times', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('branch_id')->nullable();
			$table->integer('day_id')->nullable();
			$table->dateTime('from')->nullable();
			$table->dateTime('to')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shop_branch_times');
	}

}
