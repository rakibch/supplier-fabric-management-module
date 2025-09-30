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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('company_name');
            $table->string('code')->unique();
            $table->unsignedBigInteger('added_by')->nullable(); // user id
            $table->timestamp('added_date')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('updated_date')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            //representative details
            $table->string('rep_name')->nullable();
            $table->string('rep_email')->nullable();
            $table->string('rep_phone')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('added_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->index(['country','company_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
