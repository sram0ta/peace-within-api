<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->text('title');
            $table->boolean('repeat')->default(false);

            $table->integer('date_id');
            $table->foreign('date_id')
                ->references('id')->on('dates')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['date_id']);
        });
        Schema::dropIfExists('tasks');
    }
};
