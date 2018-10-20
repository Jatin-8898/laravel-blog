<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()             /* php artisan migrate */
    {
        /* This will add the user_id col to the posts table */
        Schema::table('posts', function($table){
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()          /* php artisan migrate rollback */
    {
        /* This will drop the user_id col to the posts table */
        Schema::table('posts', function($table){
            $table->dropColumn('user_id');
        });
    }
}
