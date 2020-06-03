<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('Requested_User_ID');
            $table->integer('Site_ID');
            $table->integer('Material_ID');
            $table->date('Requested_Date');
            $table->date('Dispatch_Date');
            $table->integer('Material_Unit');
            $table->string('Quality_Checcked');
            $table->date('Quality_Checked_Date');
            $table->string('PO_Raised');
            $table->date('PO Date');
            $table->string('PO By');
            $table->string('Dispatched');
            $table->date('D/Date');
            $table->string('Reveived');
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
        Schema::dropIfExists('request_orders');
    }
}
