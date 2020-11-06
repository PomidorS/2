<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list', function (Blueprint $table) {
            $table->id();
            $table->integer('list_id');
            $table->string('name');
            $table->boolean('state_of_affairs');
            $table->timestamps();
            $table->integer('task_id')->unsigned()->default(1);
            $table->foreign('task_id')->references('id')->on('task');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('list');
        Schema::table('list', function ($table){
            $table->dropForeing('task_task_id_foreign');
            $table->foreing('task_id')->references('id')->on('task')->onDelete('cascade');
        });
    }
}
