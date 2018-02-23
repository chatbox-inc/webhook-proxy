<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class First extends Migration
{
	protected function firstTables(){
		return [
			// Slack のワークスペースを
			"m_webhook" => function(Blueprint $table){
				$table->increments("id");
				$table->string("name");
				$table->string("url");
				$table->timestamps();
			},
			"t_webhook_log" => function(Blueprint $table){
				$table->increments("id");
				$table->unsignedInteger("webhook_id");
				$table->text("request_body")->nullable();
				$table->text("request_headers")->nullable();
				$table->string("remote_host")->nullable();
				$table->text("response_status")->nullable();
				$table->text("response_body")->nullable();
				$table->text("response_headers")->nullable();
				$table->timestamps();
			},
		];
	}


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/** @var \Illuminate\Database\Schema\Builder $builder */
		$builder = app("db")->getSchemaBuilder();
		foreach ( $this->firstTables() as $table => $shema ) {
			$builder->create($table,$shema);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		/** @var \Illuminate\Database\Schema\Builder $builder */
		$builder = app("db")->getSchemaBuilder();
		foreach ( $this->firstTables() as $table => $shema ) {
			$builder->dropIfExists($table);
		}
	}
}
