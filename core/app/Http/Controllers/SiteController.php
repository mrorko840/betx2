<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\User;
use App\Models\Match;
use App\Models\League;
use App\Models\Option;
use App\Models\Result;
use App\Models\Deposit;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Question;
use App\Models\Subscriber;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\GeneralSetting;
use App\Models\SupportMessage;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    public function index(){

        $reference = @$_GET['reference'];

        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle  = 'Home';
        $sections   = Page::where('tempname',$this->activeTemplate)->where('slug','home')->first();
        $categories = Category::where('status', 1)->with('leagues')->latest()->get();
        
        $t = date('Y-m-d');
        $matches = Result::with([
            'questions'=>function($q){
                $q->where('status', 1);
            },
            'questions.options'=>function($q){
                $q->where('status', 1);
            }
        ])
        ->with('category')
        ->where('status', 1)
        ->where('match_time', 'like', '%'.$t.'%')
        ->orderBy('created_at', 'desc')
        ->paginate(getPaginate());
        
        $t = date('Y-m-d', strtotime('tomorrow'));
        
        $matches_t = Result::with([
            'questions'=>function($q){
                $q->where('status', 1);
            },
            'questions.options'=>function($q){
                $q->where('status', 1);
            }
        ])
        ->with('category')
        ->where('status', 1)
        ->where('match_time', 'like', '%'.$t.'%')
        ->orderBy('created_at', 'desc')
        ->paginate(getPaginate());
        
        return view($this->activeTemplate . 'home', compact('pageTitle','sections','categories','matches', 'matches_t'));
    }
    
     public function matches(){

        $reference = @$_GET['reference'];

        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle  = 'Match List';
        $sections   = Page::where('tempname',$this->activeTemplate)->where('slug','home')->first();
        $categories = Category::where('status', 1)->with('leagues')->latest()->get();
        
        $matches = Result::with([
            'questions'=>function($q){
                $q->where('status', 1);
            },
            'questions.options'=>function($q){
                $q->where('status', 1);
            }
        ])
        ->where('status', 1)
        ->orderBy('created_at', 'desc')
        ->get();
        return view($this->activeTemplate . 'matches', compact('pageTitle','sections','categories','matches'));
    }
    
    public function rules(){

       
        $pageTitle  = 'Rules';
        return view($this->activeTemplate . 'rules', compact('pageTitle'));
    }
    
    public function get_bet_info(Request $request){
        
         $match = Result::where('status', 1)->findOrFail($request->id);
         
         $answers = Option::where('question_id', 1)->get();
        
        return view($this->activeTemplate . 'bet-modal', compact('match', 'answers'));
        
    }

    public function matchesByLeague($slug, $id)
    {
        $league     = League::where('status', 1)->findOrFail($id);
        $sections   = Page::where('tempname', $this->activeTemplate)->where('slug','home')->first();
        $matches    = Result::runningForUser()->where('league_id', $league->id)
        ->with([
            'questions'=>function($q){
                $q->where('status', 1);
            },
            'questions.options'=>function($q){
                $q->where('status', 1);
            }
        ])
        ->paginate(getPaginate());
        $pageTitle  = $league->name.' - Matches';
        $categories = Category::where('status', 1)->with('leagues')->latest()->get();
        return view($this->activeTemplate . 'home', compact('pageTitle','categories','matches','sections'));
    }

    public function matchDetails($slug, $id)
    {
        $match      = Result::runningForUser()->findOrFail($id);
        $questions  = Question::where('status', 1)->where('match_id', $match->id)->with(['options'=>function($q){
            $q->where('status', 1);
        }])->paginate(getPaginate());

        $pageTitle  = $match->name.' - Questions';
        $categories = Category::where('status', 1)->with('leagues')->latest()->get();

        return view($this->activeTemplate . 'match_details', compact('pageTitle','categories','questions'));
    }

    public function blogs()
    {
        $count = Page::where('tempname',$this->activeTemplate)->where('slug','blog')->count();
        if($count == 0){
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'BLOG';
            $page->slug = 'blog';
            $page->save();
        }

        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','blog')->first();
        $pageTitle = 'Blogs';

        $blogs = Frontend::where('data_keys','blog.element')->latest()->paginate(getPaginate());
        $emptyMessage = 'No data found';

        return view($this->activeTemplate . 'blogs', compact('pageTitle','blogs','emptyMessage','sections'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname',$this->activeTemplate)->where('slug',$slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle','sections'));
    }


    public function contact()
    {

        $pageTitle = "Contact Us";
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','contact')->first();
        return view($this->activeTemplate . 'contact',compact('pageTitle','sections'));
    }


    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);

        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view',$ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blogDetails($id, $slug){
        $blog = Frontend::where('id',$id)->where('data_keys','blog.element')->firstOrFail();
        $pageTitle = $blog->data_values->title;
        $recentPosts = Frontend::where('data_keys','blog.element')->where('id', '!=', $id)->latest()->limit(10)->get();
        return view($this->activeTemplate.'blog_details',compact('blog','pageTitle','recentPosts'));
    }


    public function cookieAccept(){
        session()->put('cookie_accepted',true);
        return response()->json(['success' => 'Cookie accepted successfully']);
    }

    public function subscriberStore(Request $request) {

        $validate = Validator::make($request->all(),[
            'email' => 'required|email|unique:subscribers',
        ]);

        if($validate->fails()){
            return response()->json(['error' => $validate->errors()]);
        }

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        return response()->json(['success' => 'Subscribed successfully!']);
    }

    public function policyDetails($slug,$id)
    {
        $policyDetails = Frontend::where('data_keys', 'policy_pages.element')->findOrFail($id);
        $pageTitle = $policyDetails->data_values->title;

        return view($this->activeTemplate.'policy',compact('pageTitle', 'policyDetails'));
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }
    
public function payment_check(Request $request){
        $error_msg = "Unknown error";
        $auth_ok = false;
        $request_data = null;
        $sorted_request_json = null;
        if (isset($_SERVER['HTTP_X_NOWPAYMENTS_SIG']) && !empty($_SERVER['HTTP_X_NOWPAYMENTS_SIG'])) {
            $recived_hmac = $_SERVER['HTTP_X_NOWPAYMENTS_SIG'];
            $request_json = $request->getContent();
            $request_data = json_decode($request_json, true);
            ksort($request_data);
            $sorted_request_json = json_encode($request_data, JSON_UNESCAPED_SLASHES);
            if ($request_json !== false && !empty($request_json)) {
                $hmac = hash_hmac("sha512", $sorted_request_json, trim('egv+Ygx6/v6icPyPHbw7KahZ7q13uXsz'));
                if ($hmac == $recived_hmac) {
                    $auth_ok = true;
                } else {
                    $error_msg = 'HMAC signature does not match';
                }
            } else {
                $error_msg = 'Error reading POST data';
            }
        } else {
            $error_msg = 'No HMAC signature sent.';
        }
        $data = json_decode($sorted_request_json);
        
        if ( $data->payment_status == 'finished' ){
            $amount = $data->actually_paid;
            
            $deposit = Deposit::where('trx', $data->order_id)->where('status',0)->orderBy('id', 'DESC')->first();
            
            if ( !empty($deposit) ){
            $deposit->status = 1;
            $deposit->save();
            $amount = $amount - $deposit->charge;
            
        $user = User::find($deposit->user_id);
        $user->balance = $user->balance + $amount;
        $user->save();
        $transaction = new Transaction();
        $transaction->user_id = $deposit->user_id;
        $transaction->amount = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = $deposit->charge;
        $transaction->trx_type = '+';
        $transaction->details = 'Deposit Via Automatic Payment Gateway';
        $transaction->trx =  $deposit->trx;
        $transaction->save();
        
        $general = GeneralSetting::first();
        levelCommission($user, $deposit->amount, 'deposit', $deposit->trx, $general);
        
        $total = Deposit::where('user_id', $deposit->user_id)->where('status', 1)->count();
        
        if ( $total < 1){
        $fa = ($deposit->amount * 10) / 100;
        $user->balance = $user->balance + $fa;
        $user->save();
        $transaction = new Transaction();
        $transaction->user_id = $deposit->user_id;
        $transaction->amount = $fa;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '+';
        $transaction->details = 'Deposit Bonus';
        $transaction->trx =  uniqid();
        $transaction->save();
        }
        
            file_put_contents('logs/'.time().".txt", $data->order_id.' - Success');
                
            }
            
        }
        
    }

}
