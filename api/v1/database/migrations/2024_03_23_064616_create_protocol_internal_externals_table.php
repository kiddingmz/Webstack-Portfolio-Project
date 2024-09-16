<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolInternalExternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocol_internal_externals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('year')->nullable();
            $table->string('number')->nullable();
            $table->string('provenance')->nullable();
            $table->string('classification_code')->nullable();
            $table->date('doc_date')->nullable();
            $table->string('subject')->nullable();
            $table->string('destination')->nullable();
            $table->string('name_of_expander')->nullable();
            $table->string('name_of_recipient')->nullable();
            $table->string('pdf_path')->nullable();
            $table->date('date_of_receipt')->nullable();
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
        Schema::dropIfExists('protocol_internal_externals');
    }
}
