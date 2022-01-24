


<!doctype html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body style="font-family: sans-serif;">
  	<p>Dear {{$user->name}},</p>
    <div style="display: block; margin: auto; max-width: 600px;" class="main">
      <p style="font-size: 18px; font-weight: bold; margin-top: 20px">Your account has been created.Please click this link for account verification</p>
      <a href="{{ route('verify', $user->verification_token) }}">{{ route('verify', $user->verification_token) }}</a>
    <style>
      .main { background-color: white; }
      a:hover { border-left-width: 1em; min-height: 2em; }
    </style>
  </body>
</html>





