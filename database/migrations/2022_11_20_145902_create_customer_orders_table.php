<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customers_id');
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreignID('customer_shipping_address_id')->onDelete('cascade');
            // $table->foreign('customer_shipping_address_id')->references('id')->on('customer_shipping_address')->onDelete('cascade');
            $table->decimal('subtotal',9,2);
            $table->decimal('shippingfee',9,2);
            $table->decimal('total',9,2);
            $table->decimal('profit',9,2);
            $table->string('mode_of_payment');
            $table->string('payment_id')->nullable();
            $table->string('status');
            $table->string('cancellation_reason')->nullable();
            $table->string('received_by');
            $table->string('phone_number');
            // $table->string('notes');
            // $table->string('house');
            // $table->string('province');
            // $table->string('city');
            // $table->string('barangay');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('customer_orders');
    }
};
