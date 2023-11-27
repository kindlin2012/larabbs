<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->text('content');
            $table->boolean('has_read')->default(false);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('messages');
	}
};
