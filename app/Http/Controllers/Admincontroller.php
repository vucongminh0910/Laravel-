<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Rules\Captcha; 
use Validator;
use Socialite;
use App\Models\Social;
use App\Models\Login;

Session_start();
class Admincontroller extends Controller
{
    public function login_google(){
    return Socialite::driver('google')->redirect();
}
public function callback_google(){
$users = Socialite::driver('google')->stateless()->user();
// return $users->id;
$authUser = $this->findOrCreateUser($users,'google');
if($authUser){
    $account_name = Login::where('admin_id',$authUser->user)->first();
    Session::put('admin_login',$account_name->admin_name);
    Session::put('admin_id',$account_name->admin_id);
}elseif($customer_new){
    $account_name = Login::where('admin_id',$authUser->user)->first();
    Session::put('admin_login',$account_name->admin_name);
    Session::put('admin_id',$account_name->admin_id);
}

return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');

}
public function findOrCreateUser($users,$provider){
    $authUser = Social::where('provider_user_id', $users->id)->first();
    if($authUser){

    return $authUser;
    }else{
        $customer_new = new Social([
    'provider_user_id' => $users->id,
    'provider' => strtoupper($provider)

    ]);

    $orang = Login::where('admin_email',$users->email)->first();

    if(!$orang){
    $orang = Login::create([
    'admin_name' => $users->name,
    'admin_email' => $users->email,
    'admin_password' => '',

    'admin_phone' => '',
    'admin_status' => 1
    ]);
    }
    $customer_new->login()->associate($orang);
    $customer_new->save();
    return $customer_new;
    }



}
    
    public function Kiemtralogin(){
    $admin_id=Session::get('admin_id');
    if($admin_id){
    return Redirect::to('dashboard');
    }
    else{
    return Redirect::to('admin')->send();
    }
    }
    public function admin(){
    return view('admin_login');
    }
    public function showadmin(){
    $this->Kiemtralogin();
    return view('admin.dashboard');
    }
    public function dashboard(Request $request){
    $data = $request->validate([
    'admin_email' => 'required',
    'admin_password' => 'required',
    'g-recaptcha-response' => new Captcha(),         //dòng kiểm tra Captcha
    ]);
    $adminemail=$request->admin_email;
    $adminmk=md5($request->admin_password);
    $kq=DB::table('tbl_admin')->where('admin_email',$adminemail)->where('admin_password',$adminmk)->first();
    if($kq){
    Session::put('admin_name',$kq->admin_name);
    Session::put('admin_id',$kq->admin_id);
    return redirect::to('/dashboard');
    }else{
    Session::put('messages','Mật khâu hoặc tên đăng nhập không đúng ');
    return redirect::to('/admin');
    }
    }
    public function logout(){
    $this->Kiemtralogin();
    Session::put('admin_name',Null);
    Session::put('admin_id',Null);
    return redirect::to('/admin');
    }
}