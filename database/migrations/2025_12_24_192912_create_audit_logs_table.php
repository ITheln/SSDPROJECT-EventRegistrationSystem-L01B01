<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('audit_logs', function (Blueprint $table) {
        $table->id();
        
        // 1. Identify the user responsible for the action
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        
        // 2. Log the specific action (e.g., "Login Failed", "Event Created")
        $table->string('action');
        
        // 3. Store the IP address to track suspicious activities
        $table->string('ip_address');
        
        // 4. Store additional non-sensitive details
        $table->text('details')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
}
