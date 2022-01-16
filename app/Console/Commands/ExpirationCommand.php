<?php

namespace App\Console\Commands;

use App\Models\Lottery;
use App\Models\User;
use App\Models\User_Lotteries;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpirationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:lotteryExpire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change State Of The Active Coll To 2 If The Lottery Expired';

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
        //Change State Of The Lotteries To Expire After End Date
        /* $lot = Lottery::where('active', 1)->where('end_at', '<=', Carbon::now());
        $lot->update([
            'active' => 2
        ]); */
        $lot = Lottery::where('active', 1)->where('end_at', '<=', Carbon::now())->get();
        //Loop Over The Active Lotteries To Get Theire infos
        foreach ($lot as $lottery) {
            //Change Lottery State To Expire => 2
            $lottery->active = 2;
            $lottery->save();
            //Find The User In THe Lottery
            $user = User::where('id', $lottery->user_id)->first();
            $yume = User::find(1);
            //Bids Per Lottery
            $bids = (User_Lotteries::where('lottery_id', $lottery->id)->count()) * $lottery->ticket_price;
            //Add The User Share
            $user->update([
                $user->wallet = $user->wallet + ($bids / 4),
            ]);
            //Add Yume Share
            $yume->update([
                $yume->wallet = $yume->wallet + (($bids / 4) * 3),
            ]);
        }
    }
}