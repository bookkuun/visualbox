<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserJoinProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_authorities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('display_order');
            $table->timestamps();
        });

        Schema::create('user_join_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('user_authority_id')->constrained('user_authorities');
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
        Schema::dropIfExists('user_authorities');

        Schema::dropIfExists('user_join_projects');
    }
}
