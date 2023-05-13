<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class BetsController extends Controller
{
    protected $pageTitle;
    protected $emptyMessage;

    protected function filterBets($type){
        $bets               = Bet::latest();
        $this->pageTitle    = ucfirst($type). ' Bets';
        $this->emptyMessage = "No $type bet found";

        if($type != 'all'){
            $bets = $bets->$type();
        }

        if(request()->search){
            $search  = request()->search;
            $bets    = $bets->whereHas('user', function ($user) use ($search) {
                            $user->where('username', 'like',"%$search%");
                        })->orWhereHas('question', function ($question) use ($search) {
                            $question->where('name', 'like',"%$search%");
                        })->orWhereHas('question.match', function ($question) use ($search) {
                            $question->where('name', 'like',"%$search%");
                        });

            $this->pageTitle    = "Search Result for '$search'";
        }

        return $bets->with(['user','match','question','option'])->paginate(getPaginate());
    }

    public function index()
    {
        $segments       = request()->segments();
        $type           = end($segments);
        $bets           = $this->filterBets(end($segments));
        $pageTitle      = $this->pageTitle;
        $emptyMessage   = $this->emptyMessage;

        return view('admin.bet.index',compact('pageTitle', 'bets', 'emptyMessage'));
    }
    
    public function refund(Request $request){
           $id = $request->id;
           $bet = Bet::where('id', $id)->where('status', 0)->first();
           $trx = getTrx();
           
            $user = User::findOrFail($bet->user_id);
            $user->balance += $bet->invest_amount;
            $user->save();
        
            $transaction = new Transaction();
            $transaction->user_id = $bet->user_id;
            $transaction->amount = $bet->invest_amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = 0;
            $transaction->trx_type = '+';
            $transaction->details = 'Bet refunded';
            $transaction->trx =  $trx;
            $transaction->save();
            
            $bet->status = 3;
            $bet->save();
            $notify[] = ['success', $bet->invest_amount . ' has been refunded to ' . $user->username];
            return back()->withNotify($notify);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $pageTitle = 'Bet Search - ' . $search;
        $emptyMessage = 'No bet found';

        $bets = Bet::whereHas('user', function ($user) use ($search) {
            $user->where('username', 'like',"%$search%");
        })->orWhereHas('question', function ($question) use ($search) {
            $question->where('name', 'like',"%$search%");
        })->with(['user','match','question','option'])
        ->latest()
        ->paginate(getPaginate());

        return view('admin.bet.index',compact('pageTitle', 'bets', 'emptyMessage', 'search'));
    }

}
