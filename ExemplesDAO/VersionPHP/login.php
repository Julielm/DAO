<?php
require_once "autoload.php";

// ------- contrôleur -------
session_start();

// Préparation des paramètres
$param['login'] = isset($_POST['login'])?trim($_POST['login']):"";
$param['password'] = isset($_POST['password'])?trim($_POST['password']):"";
$param['erreur'] = false;
$param['message'] = "";

if (isset($_POST['quoi'])) { // le formulaire a été soumis
    if (empty($param['login']) || empty($param['password'])) {
        $param['erreur'] = true;
        $param['message'] = "Merci de saisir un nom et un mot de passe...";
    } else {
        // Recherche de l'identification dans la base
        $administrateurs = new AdministrateursDAO(MaBD::getInstance());
        $user = $administrateurs->checkUser($param['login'], $param['password']);
        if ($user == null) {
            $param['erreur'] = true;
            $param['message'] = "Erreur d'authentification (".$param['login'].").";
        } else {
            $_SESSION['login'] = $user->login;
            header("Location: gestion.php");
            exit(0);
        }
    }
}

// ------- vue -------
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
   <link rel="stylesheet" type="text/css" href="Contacts.css"/>
   <title>Authentification</title>
</head>
<body>
	<h1>Veuillez vous identifier...</h1>
<?php
   if ($param['erreur'])
      echo '<p class="erreur">', $param['message'], '</p>';
   else
      echo '<p class="normal">', $param['message'], '</p>';
?>
   <form id="formLogin" action="" method="post">
   <table><tbody>
      <tr>
         <th>Identifiant : </th>
         <td><input type="text" name="login" size="20" value="<?php echo $param['login']; ?>"/></td>
      </tr>
      <tr>
         <th>Mot de passe : </th>
         <td><input type="password" name="password" size="20" value="<?php echo $param['password']; ?>"/></td>
      </tr>
      <tr><td colspan="2" style="text-align: center; border: none;">
         <input type="submit" name="quoi" value="Connexion"/></td>
      </tr>
   </tbody></table>
   </form>
</body> 
</html>
