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
        Schema::create('fabrics', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('fabric_no')->index();
            $table->string('composition');
            $table->string('gsm')->nullable();
            $table->integer('qty')->default(0);
            $table->string('cuttable_width')->nullable();
            $table->enum('production_type', ['Sample Yardage','SMS','Bulk'])->default('Bulk');

            // optional
            $table->string('construction')->nullable();
            $table->string('pantone_code')->nullable();
            $table->string('weave_type')->nullable();
            $table->string('finish_type')->nullable();
            $table->string('dyeing_method')->nullable();
            $table->string('printing_method')->nullable();
            $table->string('lead_time')->nullable();
            $table->string('moq')->nullable();
            $table->decimal('shrinkage', 5, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->string('fabric_selected_by')->nullable();

            $table->string('image_path')->nullable();

            $table->unsignedBigInteger('added_by')->nullable();
            $table->timestamp('added_date')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('updated_date')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabrics');
    }
};
