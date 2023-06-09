<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bet;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\CommissionLog;
use App\Models\SupportTicket;
use App\Models\GeneralSetting;
use App\Models\WithdrawMethod;
use App\Rules\FileTypeValidate;
use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function home()
    {
        $pageTitle                  = 'Dashboard';
        $user                       = auth()->user();
        $widget['totalTransaction'] = Transaction::where('user_id', $user->id)->count();
        $widget['totalBet']         = Bet::where('user_id', $user->id)->count();
        $widget['totalPending']     = Bet::where('user_id', $user->id)->where('status', 0)->count();
        $widget['totalWin']         = Bet::where('user_id', $user->id)->where('status', 1)->count();
        $widget['totalLose']        = Bet::where('user_id', $user->id)->where('status', 2)->count();
        $widget['totalRefund']      = Bet::where('user_id', $user->id)->where('status', 3)->count();
        $widget['totalTicket']      = SupportTicket::where('user_id', $user->id)->count();
        $bets                       = Bet::where('user_id', auth()->user()->id)->latest()->limit(15)->with(['match','question','option'])->get();
        return view($this->activeTemplate . 'user.dashboard', compact('pageTitle', 'user', 'widget', 'bets'));
    }

    public function profile()
    {
        $pageTitle = "Profile Setting";
        $user = Auth::user();
        return view($this->activeTemplate. 'user.profile_setting', compact('pageTitle','user'));
    }

    public function submitProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|max:90|unique:users,email,' . $user->id,
            'mobile' => 'required|unique:users,mobile,' . $user->id,
        ],[
            'firstname.required'=>'First name field is required.',
            'lastname.required'=>'Last name field is required.'
        ]);

        $user = Auth::user();

        $in['firstname'] = $request->firstname;
        $in['lastname'] = $request->lastname;
        $in['email'] = $request->email;
        $in['mobile'] = $request->mobile;

        $user->fill($in)->save();
        
        $cls = 'success';
        $notify = 'Profile Informations updated successfully!';
        return response()->json(['msg'=>$notify, 'cls'=>$cls, 'data'=>$user]);
    }

    public function address()
    {
        $pageTitle = "Address Setting";
        $user = Auth::user();
        $countries  = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view($this->activeTemplate. 'user.address_setting', compact('pageTitle','user', 'countries'));
    }

    public function submitAddress(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'address' => 'sometimes|max:80',
            'state' => 'sometimes|max:80',
            'zip' => 'sometimes|max:40',
            'city' => 'sometimes|max:50'
        ]);

        $user = Auth::user();

        $in['address'] = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'city' => $request->city,
        ];

        $user->fill($in)->save();
        
        $cls = 'success';
        $notify = 'Address Informations updated successfully!';
        return response()->json(['msg'=>$notify, 'cls'=>$cls, 'data'=>$user]);
    }

    public function changePassword()
    {
        $user = Auth::user();
        $pageTitle = 'Change password';
        return view($this->activeTemplate . 'user.password', compact('pageTitle', 'user'));
    }

    public function submitPassword(Request $request)
    {

        $password_validation = Password::min(6);
        $general = GeneralSetting::first();
        if ($general->secure_password) {
            $password_validation = $password_validation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required','confirmed',$password_validation]
        ]);


        try {
            $user = auth()->user();
            if (Hash::check($request->current_password, $user->password)) {
                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                $cls = 'success';
                $notify = 'Password changes successfully!';
                return response()->json(['msg'=>$notify, 'cls'=>$cls]);
            } else {
                $cls = 'error';
                $notify = 'The password doesn\'t match!';
                return response()->json(['msg'=>$notify, 'cls'=>$cls]);
            }
        } catch (\PDOException $e) {
            $cls = 'error';
            $notify = $e->getMessage();
            return response()->json(['msg'=>$notify, 'cls'=>$cls]);
        }
    }

    /*
     * Deposit History
     */
    public function depositHistory()
    {
        $pageTitle = 'Deposit History';
        $emptyMessage = 'No history found.';
        $search = request()->search;
        if($search){
            $logs = auth()
                    ->user()
                    ->deposits()
                    ->with(['gateway'])
                    ->where('trx', 'like', "%$search%")
                    ->orderBy('id','desc')
                    ->paginate(getPaginate());
        }else{
            $logs = auth()->user()->deposits()->with(['gateway'])->orderBy('id','desc')->paginate(getPaginate());
        }

        return view($this->activeTemplate.'user.deposit_history', compact('pageTitle', 'emptyMessage', 'logs'));
    }

    /*
     * Withdraw Operation
     */

    public function withdrawMoney()
    {
        $withdrawMethod = WithdrawMethod::where('status',1)->get();
        $pageTitle = 'Withdraw Money';
        // return view($this->activeTemplate.'user.withdraw.methods', compact('pageTitle','withdrawMethod'));
        return redirect()->route('home');
    }

    public function withdrawStore(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'method_code' => 'required',
            'amount' => 'required|numeric'
        ]);
        $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
        $user = auth()->user();
        if ($request->amount > $user->balance) {
            $notify = 'You do not have sufficient balance for withdraw!';
            return response()->json(['msg'=>$notify, 'cls'=>'error']);
        }
        if ($request->amount < $method->min_limit) {
            $notify = 'Your requested amount is smaller than minimum amount!';
            return response()->json(['msg'=>$notify, 'cls'=>'error']);
        }
        if ($request->amount > $method->max_limit) {
            $notify = 'Your requested amount is larger than maximum amount!';
            return response()->json(['msg'=>$notify, 'cls'=>'error']);
        }


        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = $afterCharge * $method->rate;

        $withdraw = new Withdrawal();
        $withdraw->method_id = $method->id; // wallet method ID
        $withdraw->user_id = $user->id;
        $withdraw->amount = $request->amount;
        $withdraw->currency = $method->currency;
        $withdraw->rate = $method->rate;
        $withdraw->charge = $charge;
        $withdraw->final_amount = $finalAmount;
        $withdraw->after_charge = $afterCharge;
        $withdraw->trx = getTrx();
        $withdraw->save();
        session()->put('wtrx', $withdraw->trx);
        // return redirect()->route('user.withdraw.preview');

        return response()->json(['cls'=>'success', 'view'=>$this->withdrawPreviewAjax()]);
    }

    public function withdrawPreview()
    {
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        $pageTitle = 'Withdraw Preview';
        // return view($this->activeTemplate . 'user.withdraw.preview', compact('pageTitle','withdraw'));
        return redirect()->route('home');
    }

    //ajaxPreview
    public function withdrawPreviewAjax()
    {
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        $pageTitle = 'Withdraw Preview';
        return view($this->activeTemplate . 'user.withdraw.preview_ajax', compact('pageTitle','withdraw'))->render();
    }


    public function withdrawSubmit(Request $request)
    {
        $general = GeneralSetting::first();
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();

        $rules = [];
        $inputField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($withdraw->method->user_data as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], new FileTypeValidate(['jpg','jpeg','png']));
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $this->validate($request, $rules);

        $user = auth()->user();
        if ($user->ts) {
            $response = verifyG2fa($user,$request->authenticator_code);
            if (!$response) {
                // $notify[] = ['error', 'Wrong verification code'];
                // return back()->withNotify($notify);

                $notify = 'Wrong verification code!';
                return response()->json(['msg'=>$notify, 'cls'=>'error']);
            }
        }


        if ($withdraw->amount > $user->balance) {
            // $notify[] = ['error', 'Your request amount is larger then your current balance.'];
            // return back()->withNotify($notify);
            
            $notify = 'Your request amount is larger then your current balance!';
            return response()->json(['msg'=>$notify, 'cls'=>'error']);
        }

        $directory = date("Y")."/".date("m")."/".date("d");
        $path = imagePath()['verify']['withdraw']['path'].'/'.$directory;
        $collection = collect($request);
        $reqField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($collection as $k => $v) {
                foreach ($withdraw->method->user_data as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $directory.'/'.uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    // $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                                    // return back()->withNotify($notify)->withInput();

                                    $notify = 'Could not upload your ' . $request[$inKey];
                                    return response()->json(['msg'=>$notify, 'cls'=>'error']);
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $withdraw['withdraw_information'] = $reqField;
        } else {
            $withdraw['withdraw_information'] = null;
        }


        $withdraw->status = 2;
        $withdraw->save();
        $user->balance  -=  $withdraw->amount;
        $user->save();



        $transaction = new Transaction();
        $transaction->user_id = $withdraw->user_id;
        $transaction->amount = $withdraw->amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = $withdraw->charge;
        $transaction->trx_type = '-';
        $transaction->details = showAmount($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name;
        $transaction->trx =  $withdraw->trx;
        $transaction->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New withdraw request from '.$user->username;
        $adminNotification->click_url = urlPath('admin.withdraw.details',$withdraw->id);
        $adminNotification->save();

        notify($user, 'WITHDRAW_REQUEST', [
            'method_name' => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount' => showAmount($withdraw->final_amount),
            'amount' => showAmount($withdraw->amount),
            'charge' => showAmount($withdraw->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($withdraw->rate),
            'trx' => $withdraw->trx,
            'post_balance' => showAmount($user->balance),
            'delay' => $withdraw->method->delay
        ]);

        // $notify[] = ['success', 'Withdraw request sent successfully'];
        // return redirect()->route('user.withdraw.history')->withNotify($notify);

        $notify = 'Withdraw request sent successfully!';
        return response()->json(['msg'=>$notify, 'cls'=>'success']);
    }

    public function withdrawLog()
    {
        $pageTitle = "Withdraw Log";

        $search = request()->search;
        if($search){
            $withdraws = Withdrawal::where('user_id', Auth::id())
                       ->where('status', '!=', 0)
                       ->with('method')
                       ->where('trx', 'like', "%$search%")
                       ->orderBy('id','desc')
                       ->paginate(getPaginate());
        }else{
            $withdraws = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->orderBy('id','desc')->paginate(getPaginate());
        }

        $emptyMessage = "No Data Found!";
        return view($this->activeTemplate.'user.withdraw.log', compact('pageTitle','withdraws', 'emptyMessage'));
    }

    public function commissionsDeposit()
    {
        $pageTitle = 'Deposit Referral Commissions';
        $logs = CommissionLog::where('type','deposit')->where('to_id', auth()->user()->id)->with('user', 'bywho')->latest()->paginate(getPaginate());
        $emptyMessage = "No result found";

        return view($this->activeTemplate.'user.referral.commission', compact('pageTitle', 'logs', 'emptyMessage'));
    }

    public function commissionsBet()
    {
        $pageTitle = 'Referral Commissions on Bet';
        $logs = CommissionLog::where('type','bet')->where('to_id', auth()->user()->id)->with('user', 'bywho')->latest()->paginate(getPaginate());
        $emptyMessage = "No result found";

        return view($this->activeTemplate.'user.referral.commission', compact('pageTitle', 'logs', 'emptyMessage'));
    }

    public function commissionsWin()
    {
        $pageTitle = 'Referral Commissions on Won Bet';
        $logs = CommissionLog::where('type','win')->where('to_id', auth()->user()->id)->with('user', 'bywho')->latest()->paginate(getPaginate());
        $emptyMessage = "No result found";

        return view($this->activeTemplate.'user.referral.commission', compact('pageTitle', 'logs', 'emptyMessage'));
    }

    public function refMy($levelNo = 1)
    {
        $pageTitle = "My Referred Users";
        $emptyMessage = "No result found";
        $lev = get_user_level_count(auth()->user()->id);
        return view($this->activeTemplate. 'user.referral.users', compact('pageTitle','emptyMessage','levelNo','lev'));
    }

    public function show2faForm()
    {
        $general = GeneralSetting::first();
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->sitename, $secret);
        $pageTitle = 'Two Factor';
        return view($this->activeTemplate.'user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user,$request->code,$request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_ENABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);
            $notify[] = ['success', 'Google authenticator enabled successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }


    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $response = verifyG2fa($user,$request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts = 0;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_DISABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);
            $notify[] = ['success', 'Two factor authenticator disable successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function transactions()
    {
        $pageTitle = 'Transactions';
        $search = request()->search;

        if(request()->trx_type == 'plus'){
            $type = '+';
        }elseif(request()->trx_type == 'minus'){
            $type = '-';
        }else{
            $type = '';
        }
        
        if($search || $type){
            $transactions = Transaction::where('user_id', auth()
                            ->user()->id)
                            ->where('trx', 'like', "%$search%")
                            ->where('trx_type', 'like', "%$type%")
                            ->latest()
                            ->paginate(getPaginate());
        }else{
            $transactions = Transaction::where('user_id', auth()->user()->id)->latest()->paginate(getPaginate());
        }

        $emptyMessage = 'No transaction found';

        return view($this->activeTemplate.'user.transaction', compact('pageTitle', 'transactions', 'emptyMessage'));
    }
    
    
     public function notifications()
    {
        $pageTitle = 'Notifications';
        $notifications = Notification::where('user_id', auth()->user()->id)->latest()->paginate(getPaginate());
        $emptyMessage = 'No notifications found';

        return view($this->activeTemplate.'user.notification.index', compact('pageTitle', 'notifications', 'emptyMessage'));
    }
    
     public function notification_details($id)
    {
        $pageTitle = 'Notification Details';
        $notification = Notification::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if ( blank($notification)){
           abort(404);
        }
        $notification->status = 1;
        $notification->save();
       return view($this->activeTemplate.'user.notification.details', compact('pageTitle', 'notification'));
    }
    
    
    //placeBet
    public function place_bet(Request $request){
        $data = array();
        $user = auth()->user();
        
        if ($user->balance < $request->amount) {
            $error = 'You do not have enough balance';
            $data['success'] = false;
            $data['error'] = $error;
            echo json_encode($data);
            die();
        }
        
        $today = Bet::where('user_id', $user->id)->where('status', '!=' , 3)->whereDate('created_at', Carbon::today())->count();
        if ( $today >= 3){
            $error = 'You have placed maximum number of bet today';
            $data['success'] = false;
            $data['error'] = $error;
            echo json_encode($data);
            die();    
        }
        
        
        $check = Bet::where('user_id', $user->id)->where('match_id', $request->id)->where('status', '!=' , 3)->first();
         if ( !blank($check) ) {
            $error = 'You have already placed a bet on this match';
            $data['success'] = false;
            $data['error'] = $error;
            echo json_encode($data);
            die();
        }
        
        $user->balance -= $request->amount;
        $user->save();

        $trx = getTrx();
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $request->amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '-';
        $transaction->details = 'For a new bet';
        $transaction->trx = $trx;
        $transaction->save();

        $bet = new Bet();
        $bet->user_id       = $user->id;
        $bet->match_id      = $request->id;
        $bet->question_id   = 1;
        $bet->option_id     = $request->option;
        $bet->dividend      = 0;
        $bet->divisor       = 0;
        $bet->invest_amount = $request->amount;
        $bet->return_amount = 0;
        $bet->status = 0;
        $bet->save();
        
        $data['success'] = true;
        echo json_encode($data);
        die();
        
    }

    public function AjaxProfilePhoto(Request $request){

        $request->validate([
            'image' => 'required|image',
            
        ],[
            'image.required'=>'Image Field is required',
            'image.image'=>'It must be an Image'
        ]);

        $user = Auth::user();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $user->username.'.png';
            $location = 'assets/images/user/profile/'.$filename;
            $in['image'] = $filename;

            $path = './assets/images/user/profile/';
            $link = $path . $user->image;
            if ($link) {
                @unlink($link);
            }
            $size = imagePath()['profile']['user']['size'];
            $image = Image::make($image);
            $size = explode('x', strtolower($size));
            $image->resize($size[0], $size[0]);
            $image->save($location);
        }
        $user->fill($in)->save();

        $cls = 'success';
        $notify = 'Profile Picture Upload Successfully!';
        return response()->json(['msg'=>$notify, 'cls'=>$cls, 'img'=>$location]);
    }
    
    
}
