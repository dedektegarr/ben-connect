<?php

namespace App\Console\Commands;

use App\Http\Controllers\Kesehatan\RSUD\APIController;
use Illuminate\Console\Command;

class PostDatabaseCommand extends Command
{
    // Nama command yang bisa kamu gunakan di terminal
    protected $signature = 'postdatabase:schedule';

    // Deskripsi command
    protected $description = 'Memanggil fungsi postDatabase() secara terjadwal';

    // Controller APIController
    protected $apiController;

    public function __construct(APIController $apiController)
    {
        parent::__construct();
        $this->apiController = $apiController;
    }

    public function handle()
    {
        // Panggil fungsi postDatabase
        $this->apiController->postDatabase();
    }
}
