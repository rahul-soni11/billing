<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('bill_no', 25);
            $table->float('qty', 8,2); //4-digits, 2-decimal places
            $table->float('texable', 15, 2); ////8-digits, 2-decimal places
            $table->float('s_amount', 15, 2);
            $table->float('c_amount', 15, 2);
            $table->float('i_amount', 15, 2);
            $table->float('total', 15,4);
            $table->string('hsn_sac', 25)->nullable(true);        
            $table->string('gst_no', 25)->nullable(true);
            $table->string('party', 25)->nullable(true);
            $table->string('description')->nullable(true);            
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
        Schema::dropIfExists('expenses');
    }
}
