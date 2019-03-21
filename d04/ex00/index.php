<?php
  session_start();
  if ($_GET && isset($_GET['submit']) && $_GET['submit'] === 'OK')
  {
    if (!empty($_GET['login']) && isset($_GET['login']))
      $_SESSION['login'] = $_GET['login'];
    if (!empty($_GET['passwd']) && isset($_GET['passwd']))
      $_SESSION['passwd'] = $_GET['passwd'];
  }
  $login = '';
  $pwd = '';
  if ($_SESSION['login'])
    $login = $_SESSION['login'];
  if ($_SESSION['passwd'])
    $pwd = $_SESSION['passwd'];
?>
<!doctype html>
<html lang="fr-FR">
<head>
<meta charset="UTF-8">
<title>Ex00</title>
</head>
<html>
  <body>
    <form method="GET" action="">
      Identifiant: <input type="text" class="form-control" name="login" id="login" placeholder="Username" value="<?=$login?>">
      <br/>
      Mot de passe: <input type="password" class="form-control" name="passwd" id="passwd" placeholder="Password" value="<?=$pwd?>">
      <input type="submit" name="submit" value="OK"/>
    </form>
  </body>
</html>
<?php echo "\n" ?>