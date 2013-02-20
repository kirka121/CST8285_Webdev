<?php

if(isset($_GET['page'])){
	$display_page = true;
	$connection_pg = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
	mysql_select_db(DB_NAME, $connection_pg) or die(mysql_error());
	$q = "SELECT * FROM pages WHERE page_id='".$_GET['page']."'";
	$result = mysql_query($q, $connection_pg);
	$bdarray = mysql_fetch_array($result);
	mysql_close($connection_pg);
} else {
	echo "<div id='error'>no page selected</div>";
}
if($display_page){
?>
<table class="display_data">
	<tr>
		<td>
			<h2><?php echo $bdarray['page_title'];?></h2>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $bdarray['page_content'];?>
		</td>
	</tr>
	<tr>
		<td>
			By: <?php echo $bdarray['author'];?>
		</td>
	</tr>
	<tr>
		<td>
			On: <?php echo $bdarray['date_created'];?>
		</td>
	</tr>
</table>
<?php } ?>