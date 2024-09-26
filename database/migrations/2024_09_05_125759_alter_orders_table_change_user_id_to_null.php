<?php

use App\Models\User;
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
        Schema::table('orders', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['user_id']);

            // Make the column nullable and add the foreign key constraint again
            $table->foreignIdFor(User::class)->nullable()->change()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the modified foreign key
            $table->dropForeign(['user_id']);

            // Revert to the original foreign key constraint (non-nullable)
            $table->foreignIdFor(User::class)->change()->constrained()->cascadeOnDelete();
        });
    }
};
