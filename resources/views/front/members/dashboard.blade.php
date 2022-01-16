@extends('front.members.layouts.user')
@section('title')
{{auth()->user()->name}} || Dashboard
@endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div id="crypto-stats-3" class="row">
                <div class="card border col-md m-2">
                    <p class="card-header text-center">Wallet</p>
                    <div class="card-body text-center">
                        <span class="text-bolder">{{auth()->user()->wallet}}</span>
                    </div>
                </div>
                <div class="card border col-md m-2">
                    <p class="card-header text-center">Active Lotteries</p>
                    <div class="card-body text-center">
                        {{App\Models\Lottery::where('user_id',auth()->user()->id)->count()}}
                    </div>
                </div>
                <div class="card border col-md m-2">
                    <p class="card-header text-center">Active Bids</p>
                    <div class="card-body text-center">
                        {{App\Models\User_Lotteries::where('user_id',auth()->user()->id)->count()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
