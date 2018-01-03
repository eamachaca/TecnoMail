<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRelationsToDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
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
            $table->foreign('folder_name_id')
                ->references('id')
                ->on('folder_names');
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
        Schema::table('rosters', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('folder_id')
                ->references('id')
                ->on('folders');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('file_id')
                ->references('id')
                ->on('files');
            $table->foreign('e_mail_id')
                ->references('id')
                ->on('e_mails');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['file_id'],['e_mail_id']);
        });
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign(['mail_id']);
        });
        Schema::table('mails', function (Blueprint $table) {
            $table->dropForeign(['e_mail_id'], ['user_id']);
        });
        Schema::table('folders', function (Blueprint $table) {
            $table->dropForeign(['folder_name_id'], ['user_id']);
        });
        Schema::table('folder_mails', function (Blueprint $table) {
            $table->dropForeign(['mail_id'], ['folder_id']);
        });
        Schema::table('rosters', function (Blueprint $table) {
            $table->dropForeign(['user_id'], ['folder_id']);
        });
    }
}
