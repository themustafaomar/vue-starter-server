<?php

use App\Enums\MessageType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from_id')->constraint('users')->cascadeOnDelete();
            $table->bigInteger('to_id')->constraint('users')->cascadeOnDelete();
            $table->string('type', 25)->default(MessageType::TEXT->value);
            $table->string('body', 5000)->nullable();
            $table->boolean('is_seen')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
