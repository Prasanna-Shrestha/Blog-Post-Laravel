<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\PermissionType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permission_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('permission_id')->constrained('permissions');
            $table->enum('type',[
                PermissionType::include->value,
                PermissionType::exclude->value,
            ])
                ->default('include');
            $table->primary(['permission_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_user');
    }
};
