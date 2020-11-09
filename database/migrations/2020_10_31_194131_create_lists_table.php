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
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('state_of_affairs');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lists');
        Schema::table('lists', function ($table){
            $table->dropForeing('tasks_task_id_foreign');
            $table->foreing('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }
}
