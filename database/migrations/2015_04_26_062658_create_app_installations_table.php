<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppInstallationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('app_installations', function(Blueprint $table)
		{
			$table->increments('app_installation_id');
			$table->integer('user_id')->nullable();
			$table->bigInteger('weebly_user_id');
			$table->bigInteger('weebly_site_id');
			$table->string('access_token')->nullable();

			$table->unique(['weebly_user_id','weebly_site_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('app_installations');
	}

}
