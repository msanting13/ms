<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('card_name', ['Program', 'Project', 'Activities']);
            $table->text('description')->nullable();
            $table->longtext('message')->nullable();
            $table->year('fiscal_year')->nullable();
            $table->enum('type', ['research', 'extension']);
            $table->timestamp('deadline')->nullable();
            $table->boolean('is_lock')->default(0);
            $table->boolean('is_published')->default(0);
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
        Schema::dropIfExists('cards');
    }
}
