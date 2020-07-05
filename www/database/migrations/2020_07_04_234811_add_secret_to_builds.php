<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecretToBuilds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('builds', function (Blueprint $table) {
            $table->string('secret')->nullable()->index();
        });
        foreach (\App\Build::all() as $b) {
            $b->regenSecret();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('builds', function (Blueprint $table) {
            //
        });
    }
}
