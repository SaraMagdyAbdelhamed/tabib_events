<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('username')->nullable();
			$table->string('password')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('email')->nullable();
			$table->string('tele_code', 10)->nullable();
			$table->string('mobile')->nullable();
			$table->integer('country_id')->nullable();
			$table->integer('city_id')->nullable();
			$table->integer('gender_id')->nullable();
			$table->string('photo')->nullable();
			$table->dateTime('birthdate')->nullable();
			$table->boolean('is_active')->nullable();
			$table->boolean('is_mobile_verified')->nullable();
			$table->boolean('is_email_verified')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->string('device_token')->nullable();
			$table->string('mobile_os', 20)->nullable();
			$table->boolean('is_social')->nullable();
			$table->string('access_token')->nullable();
			$table->boolean('is_valid_token')->nullable();
			$table->string('social_token')->nullable();
			$table->boolean('lang_id')->nullable();
			$table->string('mobile_verification_code')->nullable();
			$table->string('email_verification_code')->nullable();
			$table->dateTime('last_login')->nullable();
			$table->string('longtuide', 50)->nullable();
			$table->string('latitude', 50)->nullable();
			$table->string('timezone', 100)->nullable();
			$table->rememberToken();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
