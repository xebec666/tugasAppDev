<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Notifications\GeneralNotification;
use Illuminate\Support\Facades\Auth;

try {
    $user = User::first(); // Send to the first user
    if ($user) {
        $user->notify(new GeneralNotification('Selamat Datang!', 'Akun Anda telah berhasil dibuat. Selamat berbelanja!'));
        $user->notify(new GeneralNotification('Promo Spesial', 'Dapatkan diskon 50% untuk pembelian pertama Anda.'));
        $user->notify(new GeneralNotification('Update Kebijakan', 'Kami telah memperbarui kebijakan privasi kami.'));
        echo "Sent 3 notifications to user: " . $user->email . "\n";
    } else {
        echo "No users found.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
