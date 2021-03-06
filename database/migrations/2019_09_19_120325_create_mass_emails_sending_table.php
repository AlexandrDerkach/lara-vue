<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMassEmailsSendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mass_emails_sending', function (Blueprint $table) {
            $table->bigIncrements('id');
	        $table->string('emails')->nullable();
	        $table->string('subject')->nullable();
	        $table->string('msg')->nullable();
	        $table->bigInteger('author_id')->nullable()->unsigned()->index();
	        $table->timestamps();
	        $table->foreign('author_id')
		        ->references('id')
		        ->on('users')
		        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mass_emails_sending');
    }
}
