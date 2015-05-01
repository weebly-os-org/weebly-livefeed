<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Weebly Livefeed</title>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/timeline.css">
    <link rel="stylesheet" href="css/sidebar.css">
  </head>
  <body>
    <div id="application" data-application-id="<?= $app_installation_id ?>">
      <header id="header"></header>
      <div class="wrapper" id="sidebar"></div>
      <section id="main"></section>
    </div>

    <script data-main="js/app/config/config" src="js/libs/require.js"></script>
  </body>
</html>