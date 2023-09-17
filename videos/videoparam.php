<?php

if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../init.php' );
}

$filename = $osDB->getOne('select filename from ! where userid = ? and videono = ?', array(USER_VIDEOS_TABLE, $_SESSION['video_userid'], $_SESSION['videono']) );

//$videofile = USER_VIDEO_DIR.$filename;
$path=str_replace(FULL_PATH,"",USER_VIDEO_DIR);
$videofile="../$path".$filename;
echo "<?xml version=\"1.0\" encoding=\"UTF-16\"?>
<!DOCTYPE ticker SYSTEM \"config.dtd\">
 <flvplayer>
	<config>
		<AUTO_START>false</AUTO_START>
		<AUTORESIZE>true</AUTORESIZE>

		<!-- time in seconds -->
		<BUFFER_TIME>10</BUFFER_TIME>

		<!-- options: Off, On -->
		<CONTROLS>On</CONTROLS>

		<LABEL_ON_START_CLICK>Press start to play</LABEL_ON_START_CLICK>

		<LOOPING>false</LOOPING>

		<!-- relative path to .flv file to play with this applet -->
		<VIDEO_FILE_PATH>".$videofile."</VIDEO_FILE_PATH>
		<!-- number 0-100 -->
		<VOLUME>70</VOLUME>

		<skin_color>0x555555</skin_color>
		<speaker_icon>0x000000</speaker_icon>
		<time_color>0x000000</time_color>
		<video_bar_back_color>0xaaaaaa</video_bar_back_color>
		<video_bar_loading_color>0xaaaaaa</video_bar_loading_color>
		<video_bar_progress_color>0xaaaaaa</video_bar_progress_color>
		<volume_bar_back_color>0xaaaaaa</volume_bar_back_color>
		<volume_bar_progress_color>0xaaaaaa</volume_bar_progress_color>

		<!-- options: Up Left, Down Left, Up Right, Down Right -->
		<LOGO_APPEARANCE>Up Left</LOGO_APPEARANCE>

		<LOGO_CLICK_URL>http://www.tufat.com</LOGO_CLICK_URL>

		<!-- relative path to a non-progressive JPG image -->
		<LOGO_PATH>logo_1.jpg</LOGO_PATH>
		<SHOW_LOGO>false</SHOW_LOGO>

		<visible>true</visible>
		<minHeight>225</minHeight>
		<minWidth>300</minWidth>
		<maxHeight>500</maxHeight>
		<maxWidth>590</maxWidth>

		<!-- number 0-100 -->
		<LOGO_ALPHA>50</LOGO_ALPHA>
		<VIDEO_ALPHA>100</VIDEO_ALPHA>

		<!-- options: _self, _blank, _parent, _top -->
		<LOGO_CLICK_URL_TARGET>_blank</LOGO_CLICK_URL_TARGET>

		<!-- number 0-100 -->
		<videoBrightness>80</videoBrightness>

		<!-- options: Up, Down -->
		<CONTROLS_LAYOUT>Down</CONTROLS_LAYOUT>

		<!-- work only if LOOPING == false. options: true, false -->
		<auto_reset_playhead>true</auto_reset_playhead>

		<video_back_color>0x000000</video_back_color>
		<panel_back_color>0x000000</panel_back_color>

		<!-- number 0-100 -->
		<panel_back_alpha>100</panel_back_alpha>
	</config>
</flvplayer>
 ";
?>