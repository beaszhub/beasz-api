<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\Status;
use App\Enums\Gender;
use App\Enums\RegisterType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('id_no')->nullable()->unique();
            $table->string('passport_no')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->default(Gender::male);
            $table->string('register_type')->default(RegisterType::manual);
            $table->integer('status')->default(Status::inactive);
            $table->string('password');
            $table->rememberToken();
            $table->foreignUuId('role_id')->constrained();
            $table->foreignUuId('country_id')->constrained();
            $table->timestamps();

            $table->index([
                'role_id',
                'country_id'
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
        Schema::dropIfExists('users');
    }
};