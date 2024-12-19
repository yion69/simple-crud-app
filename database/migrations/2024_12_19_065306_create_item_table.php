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
        Schema::create('item', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("item_name");
            $table->string("item_category");
            $table->double("item_price");
            $table->string("item_description");
            $table->string("item_condition");
            $table->string("item_type");
            $table->string("owner_name");
            $table->string("owner_contact_number");
            $table->string("owner_address");
            $table->double("owner_lat");
            $table->double("owner_lng");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
