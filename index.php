<?php
include_once("includes/login/include/session.php"); 
error_reporting(E_ALL);

$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME, $connection) or die(mysql_error());
$q = "SELECT * FROM settings";
$result = mysql_query($q, $connection);
$dbarray = mysql_fetch_array($result);

$q = "SELECT * FROM pages";
$result = mysql_query($q, $connection);
$num_rows = mysql_num_rows($result);

for($i = 1; $i <= $num_rows; $i++){
	$q = "SELECT * FROM pages WHERE page_id = ".$i;
	$result = mysql_query($q, $connection);
	$pgarray[$i] = mysql_fetch_array($result);
}

mysql_close($connection);
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $dbarray['site_title']; ?></title>
		<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon"> 
		<link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon"> 
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/index.css">
		<link rel="stylesheet" href="includes/jQuery.isc/jQuery.isc.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" type="text/css" href="includes/jFormer/jformer.css" ></link>
		<?php 
			if(isset($_GET['op'])){
				$op = $_GET['op'];
		      	if (is_file("assets/css/".$op.".css")) {
			      	echo ("<link rel='stylesheet' type='text/css' media='screen' href='assets/css/$op.css'>");
		      	}
			}
		?>
		<script src="http://www.google.com/jsapi"></script>
		<script>google.load("jquery", "1");</script>
		<script src="includes/jQuery.isc/jquery-image-scale-carousel.js" type="text/javascript" charset="utf-8"></script>
		<script src="includes/jquery.ez-pinned-footer.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="includes/jFormer/jFormer.js" ></script>
		<script type="text/javascript">
			//jquery source from local if CDN no work
			if (typeof jQuery == 'undefined'){
				document.write(unescape("%3Cscript src='includes/jQuery.js' type='text/javascript'%3e%3C/script%3E"));
			}
		
			$(document).ready(function(){
				$('li:not(#third)').css({'border':'0px solid #0000FF'});
			});
		
			<?php
			if ($dir = opendir('assets/carousel/')) {
				echo 'var carousel_images = [';
				while ($file = readdir($dir)) {
					list($fileName, $fileExt) = explode('.', $file);
					if (($fileExt == 'jpg') || ($fileExt == 'gif') || ($fileExt == 'png') || ($fileExt == 'jpeg')) {
						echo '"assets/carousel/' . $file . '",';
					}
			    }
				echo ']';
			    closedir($dir);
			}
			?>

			$(window).load(function() {
				$("#photo_container").isc({
					imgArray: carousel_images,
					autoplay: true,
					autoplayTimer: 5000
				});	
			});

			$(window).load(function() {
			    $("#footer").pinFooter();
			});

			$(window).resize(function() {
			    $("#footer").pinFooter();
			});
		</script>
	</head>
	<body>
		<table id="container">
			<tr>
				<td class="centered">
					<table id="header">
						<tr>
							<td id="logo_box" rowspan="2"><a href="index.php"><img src="assets/images/logo.png"></a></td>
							<td id="page_name"><h1>
								<?php echo $dbarray['site_name']; ?>
							</h1></td>
						</tr>
						<tr>
							<td class="center">
								<table class="links">
									<tr>
										<td class="links"><a class="menu" href="index.php">Home</a></td><td> | </td>
										<td class="links"><a class="menu" href="index.php?op=about">About Me</a></td><td> | </td>
										<td class="links"><a class="menu" href="index.php?op=register">Register</a></td><td> | </td>
										<td class="links"><a class="menu" href="index.php?op=downloads">Downloads</a></td><td> | </td>
										<td class="links"><a class="menu" href="index.php?op=pictures">Pictures</a></td><td> | </td>
										<td class="links">
											<div id="drop_down">
												<ul>
													<li class="parent">
														<a href="#">Labs</a>
														<ul>
															<li>
																<a href="index.php?op=lab2">Lab 2</a>
															</li>
															<li>
																<a href="index.php?op=lab3">Lab 3</a>
															</li>
															<li>
																<a href="index.php?op=lab4">Lab 4</a>
															</li>
															<li>
																<a href="index.php?op=lab5">Lab 5</a>
															</li>
														</ul>
													</li>
												</ul>
											</div>
										</td>
										<td> | </td><td class="links"><a class="menu" href="index.php?op=testing">Test</a></td>
										<?php if($dbarray['custom_pages']==1){ ?>
											<td> | </td>
											<td class="links">
												<div id="drop_down">
													<ul>
														<li class="parent">
															<a href="#">Custom Pages</a>
															<ul>
																<?php for($i = 1; $i <=$num_rows; $i++){ 
																		if($pgarray[$i]['is_visible']==1){ ?>
																			<li>
																				<a href='index.php?op=custom_page&page=<?php echo $pgarray[$i]['page_id']; ?>'><?php echo $pgarray[$i]['page_title']; ?></a>
																			</li>
																<?php 	}
																	} ?>
															</ul>
														</li>
													</ul>
												</div>
											</td>
										<?php }?>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					 <div id="photo_container"></div> 
					<table>
						<tr>
							<td id="left_container">
								<?php
									include("modules/login_form.php"); 
								?>
							</td>
							<td id="right_container">
								<?php
									if (!isset($_GET['op'])) { 
										include("modules/index.php"); 
									} else {
									  	$op = $_GET['op'];
								      	if (is_file("modules/".$op.".php")) {
								      		include("modules/".$op.".php");
								      	} else {	
											echo ("<div id='error'>Module could not be found!<br/></div>");
								      	}
									} 
								?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br />
		</div>
		<div id="footer">
    		<?php echo $dbarray['copyright']; ?>  <!--<img src="assets/images/valid-html40.gif"> -->
    		<?php
	    		$a_u = $database->num_active_users;
	    		$a_g = $database->num_active_guests;
				echo " | Members Total: ".$database->getNumMembers();
				echo " | There ";
					if($a_u == 1){echo"is";}else{echo"are";}
				echo " $a_u ";
					if($a_u == 1){echo"member";}else{echo"members";}
				echo " and ";
				echo "$a_g ";
					if($a_g == 1){echo"guest";}else{echo"guests";}
				echo " viewing the site.";
				//include("includes/login/include/view_active.php");  <-- lists all logged in active users, by username
			?>
		</div>
	</body>
</html>