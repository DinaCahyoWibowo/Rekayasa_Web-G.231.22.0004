<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
class ApiController extends Controller
{
// halaman login
public function index()
{
return view('login');
}
// halaman dashboard
public function home()
{
return view('home');
}// request API Login
public function apiLogin(Request $request)
{
$validated = $request->validate([
'email' => 'required',
'password' => 'required',
]);
$response = Http::post('http://localhost:8002/api/login', [
'email' => $request->input('email'),
'password' => $request->input('password'),
]);
$data = json_decode($response->body(),true);
if (array_key_exists('message', $data)){
$this->setCookie($data['message']);
}else{
$this->setCookie($data['access_token']);
}
return redirect('/home');
}// request API Logout
public function apiLogout()
{
$tkn = $this->getCookie();
Http::withToken($tkn)->post('http://localhost:8002/api/logout');
Cookie::forget('token');

return redirect('/');
}
// request API getWisata
public function apigetWisata()
{
$tkn = $this->getCookie();
if ($tkn <> "Unauthorized"){
$response = Http::withToken($tkn)->get('http://localhost:8002/api/wisata');
$data['query'] = json_decode($response->body(),true);
return view('list',$data);
}else{
return "Unauthorized";
}
}// Set Cookies
public function setCookie($token){
    Cookie::queue(Cookie::make('token', $token, 60));
    }
    // Get Cookie
    public function getCookie(){
    return Cookie::get('token');
    }
    }