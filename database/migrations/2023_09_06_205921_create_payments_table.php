<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PaymentStatus;
use App\Enums\PaymentStatusCode;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('order_id')->constrained();
            $table->string('transaction_id')->nullable();
            $table->integer('status_code')->default(PaymentStatusCode::pending);
            $table->string('type')->nullable();
            $table->foreignUuid('currency_id')->constrained();
            $table->decimal('amount');
            $table->string('status')->default(PaymentStatus::pending);
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('failed_at')->nullable();
            $table->timestamps();

            $table->index([
                'order_id',
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
        Schema::dropIfExists('payments');
    }
};
