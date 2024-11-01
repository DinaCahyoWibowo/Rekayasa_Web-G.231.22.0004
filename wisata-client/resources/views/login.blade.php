<h1>Silahkan Login</h1>
<form action="{{ url('login') }}" method="post" accept-charset="utf-8">
@csrf
Email: <input type="text" name="email" value="" size="20" /><br/>
Password: <input type="password" name="password" value="" size="20" /><br/>
<input type="submit" name="btn_simpan" value="Login" />
</form>