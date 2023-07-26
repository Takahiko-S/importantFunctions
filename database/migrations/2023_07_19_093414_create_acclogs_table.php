<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acclogs', function (Blueprint $table) {
            $table->id();
            $table->string('user_code')->comment('識別コード');
            $table->text('agent')->comment('アクセス');
            $table->string('check')->comment('チェック');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acclogs');
    }
};
