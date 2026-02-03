<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the empty order_items table if it exists
        Schema::dropIfExists('order_items');

        // Rename transaction_items to order_items
        if (Schema::hasTable('transaction_items')) {
            Schema::rename('transaction_items', 'order_items');
            
            Schema::table('order_items', function (Blueprint $table) {
                if (Schema::hasColumn('order_items', 'transaction_id')) {
                    $table->renameColumn('transaction_id', 'order_id');
                }
                if (Schema::hasColumn('order_items', 'quantity')) {
                    $table->renameColumn('quantity', 'qty');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                if (Schema::hasColumn('order_items', 'order_id')) {
                    $table->renameColumn('order_id', 'transaction_id');
                }
                if (Schema::hasColumn('order_items', 'qty')) {
                    $table->renameColumn('qty', 'quantity');
                }
            });
            Schema::rename('order_items', 'transaction_items');
        }
    }
};
