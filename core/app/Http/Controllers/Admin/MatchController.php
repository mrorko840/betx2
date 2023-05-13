<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bet;
use App\Models\Match;
use App\Models\League;
use App\Models\Option;
use App\Models\Result;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;

class MatchController extends Controller
{
    protected $pageTitle;
    protected $emptyMessage;

    protected function filterMatches($type){

        $matches = Result::latest();
        // if ($type == 'completed') {
        //     $matches = Result::latest();
        // } else {
        //     $matches = Result::where('status','!=',0)->latest();
        // }
        
        $this->pageTitle    = ucfirst($type). ' Matches';
        $this->emptyMessage = "No $type match found";

        if($type != 'all'){
            $matches = $matches->$type();
        }

        if(request()->search){
            $search             = request()->search;
            $matches            = $matches->where('name', 'like',"%$search%");
            $this->pageTitle    = "Search Result for '$search'";
        }

        return $matches->with(['category','league', 'questions'])->paginate(getPaginate());
    }

    public function index()
    {
        $segments       = request()->segments();
        $type           = end($segments);
        $matches        = $this->filterMatches($type);
        $leagues        = League::latest()->get();
        $pageTitle      = $this->pageTitle;
        $emptyMessage   = $this->emptyMessage;
        $options = Option::all();
        
        return view('admin.match.index',compact('pageTitle', 'matches', 'emptyMessage', 'leagues', 'options'));
    }

    public function store(Request $request, $id=0)
    {
        $request->validate([
            'name'              => 'required',
            'league_id'         => 'required|integer|gt:0',
            'beginning_time'    => 'required|date_format:Y-m-d h:i a',
            'finishing_time'    => 'required|date_format:Y-m-d h:i a|after:start_time'
        ]);

        $league = League::findOrFail($request->league_id);

        if($id){
            $match = Result::findOrFail($id);
            $notification = 'Match updated successfully';
            $match->status = $request->status ? 1 : 0;
        }else{
            $match = new Result();
            $notification = 'Match added successfully';
        }

        $match->name        = $request->name;
        $match->category_id = $league->category->id;
        $match->league_id   = $league->id;
        $match->start_time  = $request->beginning_time;
        $match->end_time    = $request->finishing_time;
        $match->profit        = $request->profit;
        $match->team_1        = $request->team_1;
        $match->team_2        = $request->team_2;
        
        $match->logo_1      = $request->logo_1;
        $match->logo_2      = $request->logo_2;
        
        $match->match_time    = $request->match_time;
        $match->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }
    
    
    public function winner(Request $request)
    {
        $request->validate([
            'score'          => 'required',
            'match_id'         => 'required',
        ]);
        $match = Result::findOrFail($request->match_id);
        $winners = Bet::where('status', 0)->where('match_id', $request->match_id)->get();
        
        foreach ($winners as $item) {
            
            if ( $item->option->id != $request->score ){
            
                $item->status = 2;
                $item->save();

                $item->user->balance += getAmount($item->invest_amount);
                $item->user->save();

                $transaction = new Transaction();
                $transaction->user_id = $item->user->id;
                $transaction->amount = getAmount($item->invest_amount);
                $transaction->post_balance = $item->user->balance;
                $transaction->charge = 0;
                $transaction->trx_type = '+';
                $transaction->details = 'Refund for lose a bet';
                $transaction->trx = getTrx();
                $transaction->save(); 
            
            } else {
            
                $p = getAmount($item->option->profit);
                $p = 0.01 * $p;
                $p = $p * $item->invest_amount;
                $d = getAmount($item->invest_amount) + getAmount($p);
                
                $item->status = 1;
                $item->save();

                $item->user->balance += $d;
                $item->user->save();

                $transaction = new Transaction();
                $transaction->user_id = $item->user->id;
                $transaction->amount = $d;
                $transaction->post_balance = $item->user->balance;
                $transaction->charge = 0;
                $transaction->trx_type = '+';
                $transaction->details = 'Won a bet';
                $transaction->trx = getTrx();
                $transaction->save();   
                
                $general = GeneralSetting::first();
                if ($general->win_commission == 1) {
                levelCommission($item->user, $p, 'win', $transaction->trx, $general);
                }
            
             
            }
            
            
        }
        
        $match->status = 0;
        $match->save();
        
        
        $notify[] = ['success', 'All bets for '.$match->name.' marked as win'];
        return back()->withNotify($notify);
        
        
    }
    
}
