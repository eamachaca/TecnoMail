<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('e_mail', 40);
            $table->integer('sended')->default(0);
            $table->integer('received')->default(0);
            $table->string('name',40);
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
        Schema::dropIfExists('e_mails');
    }
}
