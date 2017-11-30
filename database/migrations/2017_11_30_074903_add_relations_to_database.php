<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationsToDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->foreign('mail_id')
                ->references('id')
                ->on('mails');
        });
        Schema::table('mails', function (Blueprint $table) {
            $table->foreign('e_mail_id')
                ->references('id')
                ->on('e_mails');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
        Schema::table('folders', function (Blueprint $table) {
            $table->foreign('name_folders_id')
                ->references('id')
                ->on('name_folders');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
        Schema::table('folder_mails', function (Blueprint $table) {
            $table->foreign('mail_id')
                ->references('id')
                ->on('mails');
            $table->foreign('folder_id')
                ->references('id')
                ->on('folders');
        });
        Schema::table('user_lists', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->dropForeign(['mail_id']);
        });
        Schema::table('mails', function (Blueprint $table) {
            $table->dropForeign(['e_mail_id'],['user_id']);
        });
        Schema::table('folders', function (Blueprint $table) {
            $table->dropForeign(['name_folders_id'], ['user_id']);
        });
        Schema::table('folder_mails', function (Blueprint $table) {
            $table->dropForeign(['mail_id'], [ 'folder_id']);
        });
        Schema::table('user_lists', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
