<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	public function up()
	{
		Schema::create('warehouses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('housename');
            $table->integer('user_id')->unsigned()->index();
            $table->text('description')->nullable();
            $table->integer('plate_count')->unsigned()->default(0);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('warehouses');
	}
};
