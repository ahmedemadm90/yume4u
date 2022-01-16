$lot = Lottery::where('active', 1)->where('end_at', '<=', Carbon::now())->get();
    //Loop Over The Active Lotteries To Get Theire infos
    foreach ($lot as $lottery) {
    //Change Lottery State To Expire => 2
    $lottery->active = 2;
    $lottery->save();
    //Find The User In THe Lottery
    $user = User::find($lottery->user_id, 'id');
    $yume = User::find(1);
    //Bids Per Lottery
    $bids = (User_Lotteries::where('lottery_id', $lottery->id)->count()) * $lottery->ticket_price;
    //Add The User Share
    /* $user->wallet = $user->wallet + ($bids / 4); */
    $user->update([
    'wallet' => $user->wallet + ($bids / 4),
    ]);
    //$user->save();
    //Add Yume Share
    $yume->wallet = $yume->wallet + (($bids / 4) * 3);
    $yume->save();
    /* dd($yume->wallet); */
    //Users Array
    /* $biders_arr = [];
    $bider = User_Lotteries::where('lottery_id', $lottery->id)->get();
    if (isset($bider)) {
    foreach ($bider as $user) {
    array_push($biders_arr, $user->user_id);
    }
    }
    //choose the lottery winner
    $winner_id = $biders_arr[rand(0, (count($biders_arr)) - 1)];
    $lottery->winner_id = $winner_id;
    $lottery->save(); */
    }
