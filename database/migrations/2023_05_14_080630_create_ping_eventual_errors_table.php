<?php

use App\Models\Ping;
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
        Schema::create('ping_eventual_errors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ping::class)->index()->constrained();
            $table->longText('message');
            $table->string('code');
            $table->string('file');
            $table->string('line');
            $table->text('trace');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ping_eventual_errors');
    }
};
