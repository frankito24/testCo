<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchema extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 60)->nullable();
			$table->string('last_name', 60)->nullable();
			$table->integer('phone')->nullable();
			$table->date('date_birth')->nullable();
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('photo')->nullable();
		});

		Schema::create('password_resets', function(Blueprint $table)
		{
			$table->string('email')->index();
			$table->string('token')->index();
			$table->timestamp('created_at');
		});

		Schema::table('photos', function(Blueprint $table) {
        	$table->foreign('user_id')->references('id')->on('users');
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

		Schema::table('photos', function($table) {
                $table->dropForeign('photos_user_id_foreign');
        });

		Schema::drop('photos');

		Schema::drop('password_resets');

	}

}
