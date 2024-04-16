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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->double('revenue');
            $table->unsignedBigInteger('impressions');
            $table->unsignedBigInteger('clicks');
            $table->date('date');
            $table->timestamps();
            $table->index('website_id', 'report_website_idx');
            $table->foreign('website_id', 'report_website_fk')->on('websites')->references('id');

            $table->unique(['website_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
