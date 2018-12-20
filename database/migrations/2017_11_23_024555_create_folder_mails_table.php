<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFolderMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mail_id', false, true);
            $table->integer('folder_id', false, true);
            $table->string('subject', 70);
            $table->string('e_mail', 40);
            $table->json('recognized');
            $table->boolean('readed');
            $table->unique(['mail_id', 'folder_id']);
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
        Schema::dropIfExists('folder_mails');
    }
}
