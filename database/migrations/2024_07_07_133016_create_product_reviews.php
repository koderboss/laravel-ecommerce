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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('description', 1000);
            $table->string('image', 200);

            //foreign key
            $table->string('email', 50);
            $table->unsignedBigInteger('product_id');

            // Relation between products and product_details table
            $table->foreign('email')
                ->references('email')->on('user_profiles')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
