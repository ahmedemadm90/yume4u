<?php

namespace App\Console\Commands;

use App\Models\Lottery;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ActiveLottariesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ActiveCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Change State Of The Lotteries To Active On Date
        $lot = Lottery::where('active', 0)->where('start_at', Carbon::now());
        $lot->update([
            'active' => 1
        ]);
    }
}