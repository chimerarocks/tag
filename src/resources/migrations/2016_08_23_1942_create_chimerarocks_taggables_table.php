<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChimerarocksTaggablesTable
{
	public function up()
	{
		Schema::create('chimerarocks_taggables', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('tag_id');
			$table->integer('taggable_id');
			$table->integer('taggable_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('chimerarocks_taggables');
	}
}