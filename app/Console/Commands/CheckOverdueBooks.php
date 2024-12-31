<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BorrowBook;
use Carbon\Carbon;

class CheckOverdueBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-overdue-books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        BorrowBook::where('status', 'borrowed')
            ->where('due_date', '<', Carbon::now())
            ->update(['status' => 'overdue']);

        $this->info('Overdue books updated successfully');
    }
}
