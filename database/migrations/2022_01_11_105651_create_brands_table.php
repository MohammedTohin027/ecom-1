<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name_en');
            $table->string('brand_name_bn');
            $table->string('brand_slug_en');
            $table->string('brand_slug_bn');
            $table->string('brand_image');
            $table->tinyInteger('status')->default(1)->comment('0=inactive, 1=active');
            $table->tinyInteger('top_brand')->default(0)->comment('0=not_top, 1=top');
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
        Schema::dropIfExists('brands');
    }
}