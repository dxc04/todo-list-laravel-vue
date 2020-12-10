<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
     /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
         Schema::create('todos', function (Blueprint $table) {
             $table->id();
             $table->string('title', 100);
             $table->enum('status', ['NEW', 'DONE', 'UNDONE'])->nullable(false)->default('NEW');
             $table->enum('priority', ['MINOR', 'IMPORTANT', 'URGENT'])->nullable(false)->default('MINOR');
             $table->unsignedBigInteger('user_id');
             $table->timestamps();
             $table->softDeletes($column = 'deleted_at', $precision = 0);
             $table->foreign('user_id')
                 ->references('id')->on('users')
                 ->onDelete('cascade');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('todos');
     }

}
