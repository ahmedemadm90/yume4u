<?php

use App\Models\Lottery;
use App\Models\User;
use App\Models\User_Lotteries;
use Carbon\Carbon;

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