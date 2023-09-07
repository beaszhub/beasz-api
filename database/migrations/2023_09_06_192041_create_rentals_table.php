<?php

use App\Enums\RentalStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('order_id')->nullable()->constrained();
            $table->foreignUuid('product_id')->constrained();
            $table->dateTime('start_time_at')->nullable();
            $table->dateTime('end_time_at')->nullable();
            $table->foreignUuid('currency_id')->constrained();
            $table->decimal('amount')->default(0.00);
            $table->string('status')->default(RentalStatus::pending);
            $table->timestamps();

            $table->index([
                'user_id',
                'order_id',
                'product_id',
                'currency_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
};
