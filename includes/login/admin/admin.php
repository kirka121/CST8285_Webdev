<?php
  include_once("includes/login/include/session.php"); 
  if(!$session->isAdmin()){
    header("Location: index.php");
  } else {
?>
    <p>
      <font size="4">Administrator <b><?php echo $session->username; ?></b> is logged in.</font><br><br>
      <?php
        if($form->num_errors > 0){
          echo "<font size=\"4\" color=\"#ff0000\">"."!*** Error with request, please fix</font><br><br>";
        }
      ?>
    </p>
<?php
}
?>

