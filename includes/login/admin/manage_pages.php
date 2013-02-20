<?php
   
$connection_pg = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $connection_pg) or die(mysql_error());
$num_rows = mysql_num_rows($result);
$q = "SELECT * FROM pages";
$result = mysql_query($q, $connection_pg);
$num_rows = mysql_num_rows($result);

for($i = 1; $i <= $num_rows; $i++){
	$q = "SELECT * FROM pages WHERE page_id = ".$i;
	$result = mysql_query($q, $connection_pg);
	$dbarray[$i] = mysql_fetch_array($result);
}

if(isset($_POST['edit_site_page'])){
	//$_POST['edit_site_page'];
	if ($_POST['page_enabled'] == "yes"){
		$vbl = 1;
	} elseif ($_POST['page_enabled'] == "no"){
		$vbl = 0;
	}
	$q = "UPDATE pages SET page_title = '".$_POST['page_title']."', page_content = '".$_POST['page_content']."', date_modified = '".date('Y-m-d h:m:s')."', modified_by = '".$session->username."', is_visible = '".$vbl."' WHERE page_id='".$_POST['edit_site_page']."'";
	if(mysql_query($q, $connection_pg)){echo"success";} else {echo"failure";}
}

if(isset($_POST['add_site_page'])){
	if ($_POST['page_enabled'] == "yes"){
		$vbl = 1;
	} elseif ($_POST['page_enabled'] == "no"){
		$vbl = 0;
	}
	$q = "INSERT INTO pages SET page_title = '".$_POST['page_title']."', page_content = '".$_POST['page_content']."', date_created = '".date('Y-m-d h:m:s')."', author = '".$session->username."', is_visible = '".$vbl."', page_id = '".$_POST['add_site_page']."'";
	if(mysql_query($q, $connection_pg)){echo"success";} else {echo"failure";}
}

if(isset($_POST['delete_this_page'])){
	$q = "DELETE FROM pages WHERE page_id=".$_POST['delete_this_page'];
	if(mysql_query($q, $connection_pg)){echo"success";} else {echo"failure";}
}

mysql_close($connection_pg);
?>


<table class="edit_data">
	<tr>
		<td class="centered">ID</td><td> | </td>
		<td class="centered">Title</td><td> | </td>
		<td class="centered">Author</td><td> | </td>
		<td class="centered">Date Created</td><td> | </td>
		<td class="centered">Date Modified</td><td> | </td>
		<td class="centered">Modified By</td><td> | </td>
		<td class="centered">Action</td>
	</tr>
	<?php for($i = 1; $i <= $num_rows; $i++){ ?>
	<tr>
		<td class="edit_data"><?php echo $dbarray[$i]['page_id']; ?></td><td> | </td>
		<td class="edit_data"><?php echo $dbarray[$i]['page_title']; ?></td><td> | </td>
		<td class="edit_data"><?php echo $dbarray[$i]['author']; ?></td><td> | </td>
		<td class="edit_data"><?php echo $dbarray[$i]['date_created']; ?></td><td> | </td>
		<td class="edit_data">
			<?php 
				if(isset($dbarray[$i]['date_modified'])){ 
					echo $dbarray[$i]['date_modified']; 
				} else { 
					echo "never modified";
				}
			?>
		</td><td> | </td>
		<td class="edit_data"><?php echo $dbarray[$i]['modified_by']; ?></td><td> | </td>
		<td class="edit_data">
			<form action="" method="post">
				<input type="hidden" name="edit_this_page" value='<?php echo $dbarray[$i]['page_id']; ?>'>
				<input type="submit" value="Edit">
			</form>
			<form action="" method="post">
				<input type="hidden" name="delete_this_page" value='<?php echo $dbarray[$i]['page_id']; ?>'>
				<input type="submit" value="Delete">
			</form>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td class="centered" colspan="100%">
			<form action="" method="post">
				<input type="hidden" name="create_new_page" value="1">
				<input type="submit" value="Create a Page">
			</form>
		</td>
	</tr>
</table><br/>

<?php
if(isset($_POST['edit_this_page'])){
	$p_id=$_POST['edit_this_page'];
?>
<form action="" method="post">
	<table class="edit_data">
		<tr>
			<td>Title:</td>
			<td><input type="text" name="page_title" value="<?php echo $dbarray[$p_id]['page_title']; ?>"></td>
		</tr>
		<tr>
			<td>Content:</td>
			<td><textarea type="text" rows="10" cols="50" name="page_content"><?php echo $dbarray[$p_id]['page_content']; ?></textarea></td>
		</tr>
		<tr>
			<td>Created On:</td>
			<td><input type="text" name="page_date_created" disabled value="<?php echo $dbarray[$p_id]['date_created']; ?>">By: <input type="text" name="page_author" disabled value="<?php echo $dbarray[$p_id]['author']; ?>"></td>
		</tr>
		<tr>
			<td>Modified On:</td>
			<td>
				<?php if(isset($dbarray[$p_id]['date_modified'])){ ?>
					<input type="text" disabled name="page_date_modified" value="<?php echo $dbarray[$p_id]['date_modified']; ?>">By: <input type="text" name="modified_by" disabled value="<?php echo $dbarray[$p_id]['modified_by']; ?>">
				<?php } else { ?>
					never modified
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td>Enabled?</td>
			<td>
				<input type="radio" name="page_enabled" value="yes" <?php if($dbarray[$p_id]['is_visible'] == 1){echo "checked";}?>>yes
				<input type="radio" name="page_enabled" value="no" <?php if($dbarray[$p_id]['is_visible'] == 0){echo "checked";}?>>no
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="edit_site_page" value='<?php echo $p_id; ?>'>
				<input type="submit" value="Save">
			</td>
		</tr>
	</table>
</form>
<?php } 

if(isset($_POST['create_new_page'])){
?>
<form action="" method="post">
	<table class="edit_data">
		<tr>
			<td>Title:</td>
			<td><input type="text" name="page_title" placeholder="page #<?php echo $num_rows+1;?>"></td>
		</tr>
		<tr>
			<td>Content:</td>
			<td><textarea type="text" rows="10" cols="50" name="page_content"></textarea></td>
		</tr>
		<tr>
			<td>Created On:</td>
			<td><input type="text" name="page_date_created" disabled value="<?php echo date('Y-m-d h:m:s'); ?>">By: <input type="text" disabled name="page_author" value="<?php echo $session->username; ?>"></td>
		</tr>
		<tr>
			<td>Enabled?</td>
			<td>
				<input type="radio" name="page_enabled" value="yes">yes
				<input type="radio" name="page_enabled" value="no" checked>no
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="add_site_page" value='<?php echo $num_rows+1; ?>'>
				<input type="submit" value="Create">
			</td>
		</tr>
	</table>
</form>
<?php } ?>