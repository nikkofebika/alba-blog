<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('article_category_id');
            $table->string('title')->unique();
            $table->string('seo_title')->unique();
            $table->text('description');
            $table->text('sort_description');
            $table->text('image');
            $table->boolean('is_private')->default(false);
            $table->boolean('is_slider')->default(false);
            $table->smallInteger('created_by');
            $table->smallInteger('approved_by')->nullable();
            $table->dateTime('published_at')->useCurrent();
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
        Schema::dropIfExists('articles');
    }
}
