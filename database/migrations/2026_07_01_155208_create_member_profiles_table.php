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
        Schema::create('member_profiles', function (Blueprint $table) {
           $table->id();

$table->string('smart_id')->unique();

$table->string('full_name');

$table->string('email')->unique();

$table->string('country_code',10)->default('+91');

$table->string('mobile',25)->nullable();

$table->date('date_of_birth')->nullable();

$table->enum('gender',['Male','Female','Other'])->nullable();

$table->unsignedBigInteger('real_sponsor_id')->nullable();

$table->unsignedBigInteger('rising_sponsor_id')->nullable();

$table->string('real_sponsor_smart_id')->nullable();

$table->string('rising_sponsor_smart_id')->nullable();

$table->string('password');

$table->string('transaction_password');

$table->boolean('terms')->default(true);

$table->boolean('is_active')->default(true);

$table->timestamp('registration_datetime')->nullable();

$table->timestamp('first_purchase_datetime')->nullable();

$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_profiles');
    }
};
