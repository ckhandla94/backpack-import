<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsvDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('created_by', 100)->nullable();
            $table->string('last_upd_by', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();

            // now add the actual fields.
            $table->string('csv_filename', 64)->default(null)->nullable();
            $table->longText('csv_data')->default(null)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csv_data');
    }
}
