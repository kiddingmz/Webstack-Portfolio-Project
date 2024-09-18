<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrespondecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correspondeces', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('year')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('provenance')->nullable();
            $table->string('classification_code')->nullable();
            $table->date('doc_date')->nullable();
            $table->string('subject')->nullable();
            $table->string('forwarded_to')->nullable();
            $table->string('dispatch')->nullable();
            $table->string('observition')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('order_number')->nullable();
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
        Schema::dropIfExists('correspondeces');
    }
}
