<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DepositStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('order_id')->nullable()->constrained();
            $table->foreignUuid('currency_id')->constrained();
            $table->decimal('amount')->default(config('app.deposit_amount'));
            $table->dateTime('deposited_at')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->string('status')->default(DepositStatus::outstanding);
            $table->timestamps();

            $table->index([
                'user_id',
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
        Schema::dropIfExists('deposits');
    }
};
