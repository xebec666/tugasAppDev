<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    if (Schema::hasTable('notifications')) {
        echo "Table 'notifications' exists.\n";
        $columns = DB::select('DESCRIBE notifications');
        foreach ($columns as $column) {
            echo $column->Field . " (" . $column->Type . ")\n";
        }
    } else {
        echo "Table 'notifications' does NOT exist.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
