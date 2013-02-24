<table>
	<tr>
  		<td>
			<?php
				if($session->logged_in){
					//user loggen in
					?>
						<table id="login_table">
							<tr>
								<td colspan="2" id="login_table_title">
									<?php echo "<b>$session->username</b> - Online"; ?>
								</td>
							</tr>
							<tr>
								<td id="align_left">
							    	<?php echo "<a class='menu' href=\"index.php?op=control_panel\">Control Panel</a>"; ?>
								</td>
								<td id="align_left">
								   	<?php echo "<a class='menu' href=\"includes/login/process.php\">Logout</a>";	?>
					   			</td>
					   		</tr>
					   	</table>
				   	<?php
				} else {
					//user logged out
					if($form->num_errors > 0){
					   echo "<font size=\"small\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
					}
					?>
						<form action="includes/login/process.php" method="post" name="login_request">
							<table id="login_table">
								<tr>
									<td colspan="2" id="login_table_title">
										Member
									</td>
								</tr>
								<tr>
									<td>
										<?php echo $form->error("user"); ?>
										<input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>">
									</td>
									<td>
										<input type="hidden" name="sublogin" value="1">
										<input type="submit" value="Login">
									</td>
								</tr>
								<tr>
									<td>
										<?php echo $form->error("pass"); ?>
										<input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>">
									</td>
									<td>
										<input type="checkbox" name="remember" <?php if($form->value("remember") != ""){ echo "checked"; } ?>>
										<font size="1">Rmbr</font>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<a class='menu' href="index.php?op=forgotpass">Forgot Password?</a>
									</td>
								</tr>
							</table>
						</form>
					<?php
				}
			?>
		</td>
	</tr>
</table>