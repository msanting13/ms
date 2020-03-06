<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('short_description');
            $table->string('project_cost');
            $table->string('funding_source');
            $table->string('agency');
            $table->string('sdgs_addressed');
            $table->longText('beneficiaries');
            $table->string('file');
            $table->string('url')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('card_id');
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
        Schema::dropIfExists('research_reports');
    }
}
