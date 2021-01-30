<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');  // foreing key
            $table->string('post_status', 10); //public - private - draft
            $table->string('comment_status', 10); // open - close - private
            // $table->timestamps();

            // RELAZIONE fra infopost e post
            $table->foreign('post_id')
                ->references('id')
                ->on('posts');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_posts');
    }
}
