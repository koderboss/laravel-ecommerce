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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('short_description', 1000);
            $table->string('price', 50);
            $table->boolean('discount');
            $table->string('discounted_price', 50);
            $table->string('product_image', 300);
            $table->boolean('stock');
            $table->float('star');

            // foreign keys
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            
            // product badge
            $table->enum('remark', ['new', 'popular', 'top', 'special', 'trending', 'regular']);

            // Built relation between this table with product_brands and product_categories table
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('brand_id')
                ->references('id')->on('brands')
                ->restrictOnDelete()
                ->cascadeOnUpdate();


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
