<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attlogs', function (Blueprint $table) {
            $table->id();
            $table->string('employeeID', 50);
            $table->dateTime('authDateTime',6);
            $table->date('authDate',6);
            $table->time('authTime',6);
            $table->string('direction',50);
            $table->string('deviceName',50);
            $table->string('deviceSN',50);
            $table->string('personName',50);
            $table->string('cardNo',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attlogs');
    }
}
