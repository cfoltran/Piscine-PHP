<?php  
  session_start();
  // Add GET field if exists
  if ($_GET['submit'] === 'OK' && $_GET['login'] !== NULL && $_GET['passwd'] !== NULL) {
      $_SESSION['login'] = $_GET['login'];
      $_SESSION['passwd'] = $_GET['passwd'];
  }
  // if SESSION is set set two variables, then inject into html
  $login = ($_SESSION['login'] !== NULL) ? $_SESSION['login'] : '';
  $passwd = ($_SESSION['passwd'] !== NULL) ? $_SESSION['passwd'] : '';
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
      Mot de passe: <input type="password" class="form-control" name="passwd" id="passwd" placeholder="Password" value="<?=$passwd?>">
      <input type="submit" name="submit" value="OK"/>
    </form>
  </body>
</html>
<?php echo "\n" ?>