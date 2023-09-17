<?
// Set ffmpeg command format, first %s will be replaced with source file
// and second with destination
// LD_LIBRARY_PATH=. is necessary when ffmpeg with its libraries is located
// in the same directory as script
// if ffmpeg is installed by system admin, following format can be used:
// $ffmpeg_format = "ffmpeg -y -i %s %s > /dev/null 2>&1";
// standard and error outputs are redirected to /dev/null since we don't need them
// we will use ffmpeg's return value

// Detect running OS
$ffmpeg_format="";

if(strstr($_SERVER['SERVER_SOFTWARE'],"Win32"))
	$ffmpeg_format = "ffmpeg.exe -y -i %s %s";
else
	$ffmpeg_format = "LD_LIBRARY_PATH=. ./ffmpeg -y -i %s %s > /dev/null 2>&1";

$download_file = '';
$error = "";
if (isset($_POST['mpeg_submit'])) {

	// form was submited, check if file was uploaded without errors

	if ($_FILES['mpeg_file']['error'] == UPLOAD_ERR_OK) {
		$ret_value = 0;
		// prepare ffmpeg command

		$ffmpeg_command = sprintf($ffmpeg_format, $_FILES['mpeg_file']['tmp_name'], "flvs/test.flv");

		//echo $ffmpeg_command;

		if (system($ffmpeg_command, $ret_value) === FALSE || $ret_value != 0) {
			// ffmpeg was failed
			$error = "ffmpeg failure";
		} else {
			// ffmpeg successfully generated output
			$download_file = "flvs/test.flv";
		}
	} else {
		$error = 'File upload error';
	}
}
?>
<html>
<head><TITLE>mpeg2flv</TITLE></head>
<body><?=$error?><br>
<FORM method="POST" enctype="multipart/form-data">
MPEG file: <INPUT type="file" name="mpeg_file"><INPUT type="submit" name="mpeg_submit">
<? if ($download_file != '') { ?><br>You can download your file <a href="<?=$download_file?>">here</a><?}?>
</FORM>
</body>
</html>