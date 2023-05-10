<?php

use App\Models\Ping;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ping_containers', function (Blueprint $table) {
            $table->id();
            $table->string('container_id')->index();
            $table->foreignIdFor(Ping::class)->index()->constrained();
            $table->string('packets_transmitted')->nullable();
            $table->string('packets_received')->nullable();
            $table->string('packet_loss')->nullable();
            $table->string('min')->nullable();
            $table->string('avg')->nullable();
            $table->string('max')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ping_containers');
    }
};
