<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->unsignedBigInteger('receiver_id')->nullable();
        $table->timestamp('read_at')->nullable();
        $table->boolean('is_read')->default(false);
        
        $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
   public function down()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->dropColumn(['subject', 'content', 'user_id']);
    });
}
};
