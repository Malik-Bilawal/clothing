<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecenrSathes extends Migration
{
    public function up()
    {
        Schema::create('recent_searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('query');
            $table->integer('results_count')->default(0);
            $table->timestamp('searched_at');
            $table->timestamps();
            
            $table->index(['user_id', 'searched_at']);
            $table->unique(['user_id', 'query']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('recent_searches');
    }
}