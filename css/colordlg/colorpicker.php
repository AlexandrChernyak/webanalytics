<?php 
 require_once dirname(__FILE__).'/../../lib/confi/pengine.php'; 
 header("Content-type: text/css; charset: UTF-8");
 //каталог изображений
 define('COLORDLG_PATH', W_SITEPATH.'img/colordlg/');
?>
.colorpicker {
	width: 356px;
	height: 176px;
	overflow: hidden;
	position: absolute;
	background: url(<?php echo COLORDLG_PATH?>colorpicker_background.png);
	font-family: Arial, Helvetica, sans-serif;
	display: none;
	z-index: 9750;
}
.colorpicker_color {
	width: 150px;
	height: 150px;
	left: 14px;
	top: 13px;
	position: absolute;
	background: #f00;
	overflow: hidden;
	cursor: crosshair;
}
.colorpicker_color div {
	position: absolute;
	top: 0;
	left: 0;
	width: 150px;
	height: 150px;
	background: url(<?php echo COLORDLG_PATH?>colorpicker_overlay.png);
}
.colorpicker_color div div {
	position: absolute;
	top: 0;
	left: 0;
	width: 11px;
	height: 11px;
	overflow: hidden;
	background: url(<?php echo COLORDLG_PATH?>colorpicker_select.gif);
	margin: -5px 0 0 -5px;
}
.colorpicker_hue {
	position: absolute;
	top: 13px;
	left: 171px;
	width: 35px;
	height: 150px;
	cursor: n-resize;
}
.colorpicker_hue div {
	position: absolute;
	width: 35px;
	height: 9px;
	overflow: hidden;
	background: url(<?php echo COLORDLG_PATH?>colorpicker_indic.gif) left top;
	margin: -4px 0 0 0;
	left: 0px;
}
.colorpicker_new_color {
	position: absolute;
	width: 60px;
	height: 30px;
	left: 213px;
	top: 13px;
	background: #f00;
}
.colorpicker_current_color {
	position: absolute;
	width: 60px;
	height: 30px;
	left: 283px;
	top: 13px;
	background: #f00;
}
.colorpicker input {
	background-color: transparent;
	border: 1px solid transparent;
	position: absolute;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
	color: #898989;
	top: 4px;
	right: 11px;
	text-align: right;
	margin: 0;
	padding: 0;
	height: 11px;
}
.colorpicker_hex {
	position: absolute;
	width: 72px;
	height: 22px;
	background: url(<?php echo COLORDLG_PATH?>colorpicker_hex.png) top;
	left: 212px;
	top: 142px;
}
.colorpicker_hex input {
	right: 6px;
}
.colorpicker_field {
	height: 22px;
	width: 62px;
	background-position: top;
	position: absolute;
}
.colorpicker_field span {
	position: absolute;
	width: 12px;
	height: 22px;
	overflow: hidden;
	top: 0;
	right: 0;
	cursor: n-resize;
}
.colorpicker_rgb_r {
	background-image: url(<?php echo COLORDLG_PATH?>colorpicker_rgb_r.png);
	top: 52px;
	left: 212px;
}
.colorpicker_rgb_g {
	background-image: url(<?php echo COLORDLG_PATH?>colorpicker_rgb_g.png);
	top: 82px;
	left: 212px;
}
.colorpicker_rgb_b {
	background-image: url(<?php echo COLORDLG_PATH?>colorpicker_rgb_b.png);
	top: 112px;
	left: 212px;
}
.colorpicker_hsb_h {
	background-image: url(<?php echo COLORDLG_PATH?>colorpicker_hsb_h.png);
	top: 52px;
	left: 282px;
}
.colorpicker_hsb_s {
	background-image: url(<?php echo COLORDLG_PATH?>colorpicker_hsb_s.png);
	top: 82px;
	left: 282px;
}
.colorpicker_hsb_b {
	background-image: url(<?php echo COLORDLG_PATH?>colorpicker_hsb_b.png);
	top: 112px;
	left: 282px;
}
.colorpicker_submit {
	position: absolute;
	width: 22px;
	height: 22px;
	background: url(<?php echo COLORDLG_PATH?>colorpicker_submit.png) top;
	left: 322px;
	top: 142px;
	overflow: hidden;
}
.colorpicker_focus {
	background-position: center;
}
.colorpicker_hex.colorpicker_focus {
	background-position: bottom;
}
.colorpicker_submit.colorpicker_focus {
	background-position: bottom;
}
.colorpicker_slider {
	background-position: bottom;
}
