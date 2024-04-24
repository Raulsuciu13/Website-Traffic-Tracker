<?php

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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_uuid', 36);
            $table->string('page_url', 255);
            $table->timestamp('timestamp')->nullable();

            // Add indexes
            $table->index(['visitor_uuid', 'page_url']); // Index for selecting id by visitor_uuid and page_url
            $table->index('timestamp'); // Index for selecting page_url and timestamp by date interval
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
};
