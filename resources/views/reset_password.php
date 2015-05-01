<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Weebly Livefeed</title>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/auth.css">
  </head>
  <body>
    <form class="user-form" method="POST">
      <p class="user-text">
        <span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-lock fa-stack-1x"></i>
        </span>
      </p>
      <input name="username" type="username" disabled value="<?= $user->username ?>"class="user-username" autofocus="true" required="true" placeholder="Username" />
      <input name="password" type="password" class="user-password" required="true" placeholder="Password" />
      <input type="submit" class="submit">
    </form>
    <div class="underlay-photo"></div>
    <div class="underlay-black"></div>
  </body>
</html>