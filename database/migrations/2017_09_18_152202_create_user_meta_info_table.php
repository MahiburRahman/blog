<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetaInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meta_info', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('first_name' , 50);
            $table->string('last_name' , 50);
            $table->string('country_iso2_code', 5);
            $table->string('country_phone_code', 10);
            $table->string('phone', 30);
            $table->timestamp('last_login')->nullable();
            $table->primary('id');
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
        Schema::dropIfExists('user_meta_info');
    }
}
