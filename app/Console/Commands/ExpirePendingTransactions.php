<?php

namespace App\Console\Commands;

use App\Services\TransactionExpiryService;
use Illuminate\Console\Command;

class ExpirePendingTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:expire-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire pending Dreamella transactions whose payment deadline has passed';

    /**
     * Execute the console command.
     */
    public function handle(TransactionExpiryService $service): int
    {
        $count = $service->expireOverduePending();

        $this->info("Expired {$count} pending transaction(s).");

        return self::SUCCESS;
    }
}
