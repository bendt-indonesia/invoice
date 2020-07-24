<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bank_id');
            $table->string('account_name',150);
            $table->string('account_no',150);
            $table->string('bank_branch',150)->nullable();
            $table->string('bank_address',150)->nullable();
            $table->string('bank_phone',50)->nullable();
            $table->string('bank_fax',50)->nullable();
            $table->string('bank_va_no',10)->nullable();

            $table->unsignedBigInteger('start_number')->default(1);
            $table->unsignedBigInteger('end_number')->default(1);
            $table->tinyInteger('number_length')->default(8);
            $table->unsignedBigInteger('current_number')->default(1);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->unsignedInteger('created_by_id')->nullable();
            $table->unsignedInteger('updated_by_id')->nullable();
            $table->unsignedInteger('deleted_by_id')->nullable();
            $table->softDeletes();

            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('deleted_by_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_payment');
    }
}
