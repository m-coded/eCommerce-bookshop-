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
        Schema::create('popularbooks', function (Blueprint $table) {
            $table->id();
            $table->string('author')->nullable();
            $table->string('image_path'); // Store image path, not the file itself            $table->decimal('price', 8, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->default(0.00);

            


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popularbooks');
    }
};
