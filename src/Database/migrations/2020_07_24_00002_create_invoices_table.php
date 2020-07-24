<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_no', 20)->nullable();
            $table->string('po_no', 20)->nullable();

            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('invoice_status_id');

            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->integer('period')->default(1);

            $table->decimal('sub_total',15,3)->default(0);
            $table->decimal('discount_price',15,3)->default(0);
            $table->decimal('ppn_total',15,3)->default(0);

            $table->decimal('total_paid',15,3)->default(0);

            $table->text('remark')->nullable();
            $table->text('remark_client')->nullable();
            $table->boolean('is_ppn')->default(true);

            $table->string('invoice_file',250)->nullable();

            //OPTIONAL CUSTOMER DATA
            $table->string('customer_tax_no', 20)->nullable();
            $table->string('customer_tax_address',200)->nullable();
            $table->string('customer_address_1',150)->nullable();
            $table->string('customer_address_2',150)->nullable();
            $table->string('province_name',150)->nullable();
            $table->string('city_type',150)->nullable();
            $table->string('city_name',150)->nullable();
            $table->string('kec_name',150)->nullable();
            $table->string('kel_name',150)->nullable();
            $table->string('zip',10)->nullable();

            $table->timestamps();
            $table->unsignedInteger('created_by_id')->nullable();
            $table->unsignedInteger('updated_by_id')->nullable();
            $table->unsignedInteger('deleted_by_id')->nullable();
            $table->softDeletes();

            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('deleted_by_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');

            $table->string('reference_no', 20)->nullable();
            $table->string('item_name', 255);

            $table->decimal('price',15,3)->default(0);
            $table->integer('quantity')->default(1);

            $table->timestamps();
            $table->unsignedInteger('created_by_id')->nullable();
            $table->unsignedInteger('updated_by_id')->nullable();
            $table->unsignedInteger('deleted_by_id')->nullable();
            $table->softDeletes();

            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('deleted_by_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::create('invoice_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('bank_payment_id')->nullable();

            $table->dateTime('payment_date');
            $table->string('transaction_no', 30)->nullable();
            $table->string('receipt_no', 30)->nullable();
            $table->unsignedInteger('payment_via_id');
            $table->unsignedInteger('payment_status_id');
            $table->decimal('nominal',15,3)->default(0);

            $table->timestamps();
            $table->unsignedInteger('created_by_id')->nullable();
            $table->unsignedInteger('updated_by_id')->nullable();
            $table->unsignedInteger('deleted_by_id')->nullable();
            $table->softDeletes();

            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');
            $table->foreign('bank_payment_id')->references('id')->on('bank_payment')->onDelete('restrict');

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
        Schema::dropIfExists('invoice_payment');
        Schema::dropIfExists('invoice_detail');
        Schema::dropIfExists('invoice');
    }
}
