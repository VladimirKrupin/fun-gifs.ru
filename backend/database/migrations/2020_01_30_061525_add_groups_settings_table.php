<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('access_token');
            $table->string('group_id');
            $table->string('api_v');
            $table->string('private_key');
            $table->string('name');
            $table->string('key_words');
            $table->string('description');
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
        Schema::dropIfExists('groups_settings');
    }
}
