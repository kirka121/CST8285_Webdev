<?php
	//edit this
	$_max_file_size = '3000000'; //file size in bytes.
	$upload_dir = "uploads/"; //upload folder..chmod to 777
	$_i = "1"; //number of files to upload at one time
	//end edit

	echo "<table width=100% border=0 cellpadding=0 cellspacing=0>";
	echo "<form enctype='multipart/form-data' action='index.php?op=pictures?do=upload' method='post' style=\"margin: 0px;\">";
	echo "<tr><td><input type='hidden' name='MAX_FILE_SIZE' value='" . $_max_file_size , "'></td></tr>";
	if($_GET != 'upload'){
		echo "<tr><td class=redtext>Photo Must Be 250px W by 250px H and in .JPG or .GIF format.</td></tr>";
		echo "<tr><td>&nbsp;</td></tr>";
		echo "<tr><td class=bodytext>Choose your image:<br>";
		//show number of files to select
		for($i=0; $i <= $_i-1;$i++){
			echo "<input name='file" . $i . "' type='file'></td></tr>";
		}
		echo "<tr><td class=bodytext><input type=submit name=Submit value=\"Upload Photo\" style=\"font-family: Verdana; font-size: 8pt; font-weight: bold; BACKGROUND-COLOR: #5E6456; COLOR: #ffffff;\"></td></tr>";
	}
	if(isset($_GET['do'])){
		$do = $_GET['do'];
		if($do == 'upload'){
			//upload all the fields until done
			for($i=0; $i <= $_i-1; $i++){
				//file with the upload folder
				$target_path = $upload_dir . basename($_FILES);
				$target_path = str_replace (" ", "", $target_path);
				//actual file name with the random number
				$_file_name = basename($_FILES);
				$_file_name = str_replace (" ", "", $_file_name);
				//do not upload the 'left blank' fields
				if(basename($_FILES) != ''){
					if(move_uploaded_file($_FILES, $target_path)){
						//uploaded successfuly
						$_uploaded=1;
					} else {
						//error uploading
						$_error=1;
					}
				} else {
					$_check=$_check+1;
				}
			}

			//file(s) did upload
			if($_uploaded == '1'){
				$_uploaded=0;
				$adID = $_GET['do'];
				mysql_query("update tbl_whatever set photo = '".$_file_name."' WHERE whatever = '$whatever ");
			}
			//file uploaded?
			if($_error == '1'){
				$_error=0;
				echo "<div>There was an error uploading some of the file(s), please try again! Maybe the file size is too large. Maximum file size is 3MB</div>";
			}
			//user selected a file?
			if($_check == $_i){
				$_check=0;
				echo "<div>Select a file first than click 'Upload File'</div>";
			}
		}
	}
	echo "</td></tr>";
?>
</table>