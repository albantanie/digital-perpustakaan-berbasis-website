<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // $table->foreignId('category_id')->constrained();
            $table->dropForeign(['category_id']);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->text('description')->nullable();
            $table->integer('quantity');
            $table->string('file_path');
            $table->string('cover_path');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
