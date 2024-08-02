<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Brand;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->foreignIdFor(Category::class)->constrained()->onCascadeDelete();;
            $table->foreignIdFor(Brand::class)->constrained()->onCascadeDelete();;
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->integer('stock');
            $table->decimal('price', 8, 2);
            $table->string('dimensions')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->decimal('discount', 8, 2)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
