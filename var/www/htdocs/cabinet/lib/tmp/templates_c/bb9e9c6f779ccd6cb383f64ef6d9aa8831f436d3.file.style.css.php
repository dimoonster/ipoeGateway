<?php /* Smarty version Smarty-3.1.7, created on 2012-03-05 17:55:12
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/style.css" */ ?>
<?php /*%%SmartyHeaderCode:5316120394f391fb3bceb28-13578696%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb9e9c6f779ccd6cb383f64ef6d9aa8831f436d3' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/style.css',
      1 => 1330955708,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5316120394f391fb3bceb28-13578696',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f391fb3d88e0',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f391fb3d88e0')) {function content_4f391fb3d88e0($_smarty_tpl) {?>
@charset "utf-8";
body { margin:0; padding:0; width:100%;  background:#fff; font-size:11px; }
html { padding:0; margin:0;}
li.bg, .bg { clear:both; padding:0; margin:2px 5px; height:5px; border-bottom:1px dashed #ccc; list-style:none;}
p.clr, .clr { clear:both; padding:0; margin:0;}
.main { margin:0 auto; padding:0;}

/* header */
.header_resize { margin:0 auto; padding:0; width:930px;}
.header { margin:0; padding:0;}
/* logo */
.logo { width:500px; margin:0 auto; padding:0; float:left; background:url(<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/logo.gif) no-repeat left 34px;}
h1 { margin:0; padding:32px 0 32px 40px; color:#5d5d5d; font:normal 40px/1.2em Arial, Helvetica, sans-serif;}
h1 a, h1 a:hover { color:#5d5d5d; text-decoration:none;}
h1 span { font-weight:bold; color:#4aaede;}
h1 small { display:block; padding-left:184px; font:normal 14px/1.2em Arial, Helvetica, sans-serif;}
/* search */
.search { padding:40px 20px 0 0; margin:0; width:260px; float:right;}
.search form { float:right; padding:0; margin:0;}
.search span { display:block; float:left; background:#fff; width:215px; border:1px solid #eee; padding:0 5px;}
.search form .keywords { width:149px; line-height:14px; height:14px; float:left; background:none; border:0; padding:6px 2px; margin:0; font:normal 11px Arial, Helvetica, sans-serif; color:#acacac;}
/*menu*/
.menu { padding:0; margin:0 auto ; width:930px; border-bottom:1px solid #a5a5a5; border-top:1px solid #a5a5a5; }
.menu ul {  padding:0; margin:0; list-style:none; border:0; float:left;}
.menu ul li { float:left; margin:0; padding:15px 5px; }
.menu ul li a { float:left; margin:0; padding:0 10px 0 15px; color:#59554a; font:normal 14px Arial, Helvetica, sans-serif; text-decoration:none; text-transform:uppercase; background:url(<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/menu_bg.gif) left no-repeat;}
.menu ul li a:hover { color:#1d9ad6; }
.menu ul li a.active {  color:#1d9ad6; }
/* headert_text_resize */
.headert_text_resize { width:930px; padding:5px 0 0 0; margin:0 auto;}
.headert_text_resize img { float:left; margin:0; padding:30px 0 0 20px;}
.headert_text_resize .textarea {  width:720px; margin:0; padding:20px 0 0 5px; float:right; background:url(<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/header_block_bg.gif) top no-repeat;}
.headert_text_resize .textarea h2 { border-bottom:1px dashed #ccc; font: normal 26px Arial, Helvetica, sans-serif; color:#626262; padding:10px 0; margin:0; }
.headert_text_resize .textarea h2 span { color:#1d9ad6;}
.headert_text_resize .textarea a { font: bold 16px Arial, Helvetica, sans-serif; color:#1d9ad6; text-decoration:none;}
/*body*/
.body_resize { margin:0 auto; padding:20px 0 0 0; width:930px;}
.body { margin:0; padding:10px 25px 40px 25px;}
.body h3 {  font: bold 24px Arial, Helvetica, sans-serif; color:#585858; padding:10px 0; margin:5px 0 10px 0; border-bottom:1px solid #999999; border-top:1px solid #999999; }
.body h3 span { color:#1d9ad6;}
.body h2 {  font: normal 30px Arial, Helvetica, sans-serif; color:#585858; padding:3px 0 3px 5px; margin:5px 0 10px 0; }
.body h2 span { color:#1d9ad6;}
.body p { font: normal 14px Arial, Helvetica, sans-serif; color:#585858; padding:5px; margin:0; line-height:1.8em;}
.body img { float:left; margin:5px; padding:0;}
.body img.floated { float:right; margin:10px; padding:0;}
.body a { color:#1d9ad6; text-decoration:none; font-weight:bold;}
.body a:hover { text-decoration:underline;}
.left { float:left; width:640px; margin:0; padding:0;}
.right { float:right; width:265px; margin:0; padding:0;}
.right .blog { border:1px solid #dedede; margin:10px 0; padding:10px;  border-radius: 7px; -moz-border-radius:7px; -webkit-border-radius:7px; background:#fff;}
.right ul { list-style:none; margin:5px 10px; padding:0;}
.right li { font: normal 14px Arial, Helvetica, sans-serif; color:#464646;  padding:5px 0;}
.right li a {  background: url(<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/ul_li.gif) left no-repeat; padding:0 0 0 20px; margin:0; font: normal 14px Arial, Helvetica, sans-serif; color:#626262; text-decoration:none;}
.right li a:hover { color:#1d9ad6; text-decoration:none; }
.right ul.sponsors { list-style:none; margin:5px 10px; padding:0;}
.right li.sponsors { border-bottom:1px dashed #ccc; font: normal 12px Arial, Helvetica, sans-serif; color:#585858;  padding:5px 0;}
.right li.sponsors span { padding:0 0 0 20px; color:#999999; font: 11px Arial, Helvetica, sans-serif;}
.border_blog { border:1px solid #ccc; margin:0 auto 15px auto; padding:10px 5px;}
/* FBG */
.FBG_resize { margin:0 auto; padding:0; width:930px; background:#fff;}
.FBG { margin:0; padding:0; }
.FBG img { float:left; margin:5px 10px 5px 0; padding:0;}
.FBG h2 { color:#585858;  font: normal 30px Arial, Helvetica, sans-serif;  padding:3px 0; margin:5px 0 15px 0;}
.FBG p { color:#464646; font: normal 12px Arial, Helvetica, sans-serif;  padding:5px 0; margin:0; line-height:1.8em;}
.FBG a  { color:#1d9ad6; text-decoration:none; font: bold 12px Arial, Helvetica, sans-serif;}
.FBG ul { list-style:none; float:left; padding:0; margin:10px 0;}
.FBG li { padding:2px 1px; margin:0;}
.FBG li a { color:#1d9ad6; font: normal 12px Arial, Helvetica, sans-serif;  text-decoration: none; text-transform:uppercase;}
.FBG li a:hover { color:#464646; text-decoration:none;}
.FBG .blok { width:270px; float:left; padding:5px 20px; margin:0;}
/* footer */
.footer_resize { margin:0 auto; padding:25px 0; width:930px;}
.footer h3 {  font: bold 24px Arial, Helvetica, sans-serif; color:#585858; padding:10px 0; margin:5px 0 10px 0; border-bottom:1px solid #999999; border-top:1px solid #999999; }
.footer { padding:0; margin:0 auto; }
.footer img { float:left; margin:10px; padding:0;}
.footer p { color:#585858; font: normal 12px Arial, Helvetica, sans-serif; padding:0 0 0 5px; margin:0; line-height:1.8em;}
.footer a { color:#1d9ad6; text-decoration:none;}
/********** contact form **********/
#contactform { margin:0; padding:5px 10px; }
#contactform * { color:#F00; }
#contactform ol { margin:0; padding:0; list-style:none; }
#contactform li { margin:0; padding:0; background:none; border:none; display:block; clear:both; }
#contactform li.buttons { margin:5px 0 5px 0; }
#contactform label { margin:0; width:110px; display:block; padding:10px 0; color:#666; font: normal 12px Arial, Helvetica, sans-serif; text-transform:capitalize; float:left; }
#contactform label span { color:#F00; }
#contactform input.text { width:480px; border:1px solid #c0c0c0; margin:2px 0; padding:5px 2px; height:16px; background:#fff; float:left; }
#contactform textarea { width:480px; border:1px solid #c0c0c0; margin:2px 0; padding:2px; background:#fff; float:left; }
#contactform li.buttons input { border:1px solid #000; background:#1d9ad6; padding:10px; margin:10px 0 0 110px;  color:#fff; float:left; font: normal 12px Arial, Helvetica, sans-serif;}
p.response { text-align:center; color:#F00; font: normal 11px Georgia, "Times New Roman", Times, serif; line-height:1.8em; width:auto; }

.loginForm { width:320px; border: 1px solid #aaa; padding:20px; background:#eee; margin:100px auto;}
.loginForm form .line { width: 300px; display:block; border: 0px solid #000;}
.loginForm form .line label { color:#464646; display:block; width:150px; border: 0px solid #000; float:left; font: normal 14px Arial, Helvetica, sans-serif; text-align:right; padding:6px;}
.loginForm form .line input { display:block; float:left; width: 120px; margin-left:5px; padding:5px 2px; border:1px solid #c0c0c0; font: normal 14px Arial, Helvetica, sans-serif;}
.loginForm form .lineSubmit { width:320px; text-align:center; border: 0px solid #000; border-top: 1px dashed #000; margin-top:5px;}
.loginForm form .lineSubmit input { width: 120px; margin-left:0px; padding:5px 2px; border:1px solid #c0c0c0; font: bold 14px Arial, Helvetica, sans-serif; color:#4aaede; cursor:pointer; margin-top:5px;}
.loginForm form .lineAuthErr { width:320px; text-align:center; border: 0px solid #000; border-bottom: 1px dashed #000; margin:5px; color:#f00; font: bold 14px Arial, Helvetica, sans-serif; padding-bottom:5px;}

.infoBlock { float:left; width:600px; border: 1px solid #aaa;padding:10px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;}
.infoBlock .title { color:#464646; border: 1px solid #888; background:#ddd; font: bold 14px Arial, Helvetica, sans-serif; padding: 5px; margin-bottom: 5px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;}
.infoBlock .line { width:590px; font: normal 11px Tahoma, sans-serif; margin: 3px; background:#f3f3f3;}
.infoBlock .infoline { width:590px; font: normal 10px Tahoma, sans-serif; margin: 3px; text-align: right; color:#aaa;}
.infoBlock .line label { width:180px; text-align:right; display:block; float:left; background:#fff; padding:5px;margin-right:5px;}
.infoBlock .line span { width:370px; display:block; float:left; margin-left:1px; padding:5px; background:#f3f3f3;}
.infoBlock .line span.off { color:#a00; }
.infoBlock .line span.on { color:#00aa00; }
.infoBlock .spacer { border-bottom:1px dashed #aaa; height:10px; margin-bottom:10px;} 

.infoSpacer { clear:both; padding-top:10px;}
.infoText { font: bold 16px Arial, sans-serif; color:#b0b0b0;}

.infoBlock2 { float:left; width:930px; border: 0px solid #aaa;padding:1px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; margin-right:20px; }
.infoBlock2 .title { cursor:pointer; color:#464646; border: 1px solid #888; background:#ddd; font: bold 14px Arial, Helvetica, sans-serif; padding: 5px; margin-bottom: 5px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;}
.infoBlock2 .line { width:430px; font: normal 11px Tahoma, sans-serif; margin: 3px; background:#f3f3f3;}
.infoBlock2 .infoline { width:430px; font: normal 10px Tahoma, sans-serif; margin: 3px; text-align: right; color:#aaa;}
.infoBlock2 .line label { width:180px; text-align:right; display:block; float:left; background:#fff; padding:5px;margin-right:5px;}
.infoBlock2 .line span { width:170px; display:block; float:left; margin-left:1px; padding:5px; background:#f3f3f3;}
.infoBlock2 .line span.off { color:#a00; }
.infoBlock2 .line span.on { color:#00aa00; }
.infoBlock2 .spacer { border-bottom:1px dashed #aaa; height:10px; margin-bottom:10px;} 
.infoBlock2 .list { height: 450px; overflow:auto; display:none;}

div.pager { display:block; border: 0px solid #000; }
div.pager input.pagedisplay { border: 1px dotted #aaa; width:4em; float:left; text-align:center; font: bold 11px Tahoma, sans-serif; padding:3px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px;}
div.pager img.first, img.next, img.prev, img.last { float:left; }
div.pager .pagesize { float:left; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:3px; border:1px solid #aaa;}

.bubbleInfo { width:128px; position:static; float:left; margin:20px;}
.bubbleInfo .icon { text-align:center; z-index:0;cursor:pointer;}
.bubbleInfo .icon img { border:0px; height:128px; float:left; margin:5px 0px 15px 0px;}
.bubbleInfo .icon p { display: block; font: bold 14px Tahoma, sans-serif; }
.bubbleInfo .popup { position:absolute; display: none; border:0px solid #000; width:99%; height:300px;overflow:auto;z-index:10;padding:5px;}
.bubbleInfo .popup .info { width:600px; height:280px;position:relative; overflow:auto; background:#f0f0f0;padding:3px;border:0x solid #000; margin:auto; -webkit-box-shadow: 0 -0px 10px rgba(0,0,0,0.5);-moz-box-shadow: 0 0 10px rgba(0,0,0,0.5); box-shadow: 0 0 10px rgba(0,0,0,0.5);filter: progid:DXImageTransform.Microsoft.shadow(direction=120, color=#000000, strength=10);}

.bubbleInfo .popup .info .title { font: bold 20px Tahoma, sans-serif; margin: 4px auto; text-align:center;border-bottom:1px dashed #aaa; padding-bottom: 10px;}
.bubbleInfo .popup .info p { font:normal 14px Arial, Helvetica, sans-serif; text-align:justify; text-indent: 25px;}

#ajaxContainer { display: none; }
.ajaxContentBorder { padding:10px; background:#fafafa; border:1px solid #f6f6f6; width:900px; margin:auto; -webkit-box-shadow: 0 -0px 10px rgba(0,0,0,0.5);-moz-box-shadow: 0 0 10px rgba(0,0,0,0.5); box-shadow: 0 0 10px rgba(0,0,0,0.5);filter: progid:DXImageTransform.Microsoft.shadow(direction=120, color=#000000, strength=10);}
.ajaxContentBorder .close { float:right; cursor: pointer; color: #da0000; font: bold 11px Arial; }

.speedList { float:left; width:365px; border:0px solid #000;}
.speedList .title { font: bold 10px Arial; color:#999;}
.speedList .title .titleTime { float:left; width:100px; text-align:center; background:#fff;padding:5px;margin:2px;border-bottom:1px dashed #e0e0e0;}
.speedList .title .titleSpeed { float:left; width:100px; text-align:center;background:#fff;padding:5px;margin:2px;border-bottom:1px dashed #e0e0e0;}
.speedList .title .titleCost { float:left; width:100px; text-align:center;background:#fff;padding:5px;margin:2px;border-bottom:1px dashed #e0e0e0;}

.speedList .data { height:300px; overflow:auto; }
.speedList .data .line { font: normal 11px Arial; color:#999; }
.speedList .data .line .elem1 { float:left; width:100px; text-align:center; background:#f8f8f8; padding:5px;margin:2px;}
.speedList .data .line .elem2 { float:left; width:100px; text-align:right; background:#f8f8f8; padding:5px;margin:2px;}
.speedList .data .line .elem3 { float:left; width:100px; text-align:right; background:#f8f8f8; padding:5px;margin:2px;}

.createOptions { float:left; width:400px; margin-left:20px; border:0px solid #000; }
.createOptions .title { text-align:center; font: bold 14px Arial; padding-bottom:5px; border-bottom:1px dashed #ddd;margin-bottom:5px; color:#8f8f8f;}

.createOptions .line { font: normal 12px Tahoma; padding-bottom:20px; border:0px solid #000;display:block;}
.createOptions .cline { font: normal 12px Tahoma; padding-bottom:20px; border:0px solid #000;display:block;text-align:center;}
.createOptions .linedescr { font: normal 11px Tahoma; padding-bottom:5px; border-bottom:1px dashed #ddd;display:block;margin-bottom:5px;}
.createOptions .linedescr em { font: italic 11px Arial; }
.createOptions .line .label { float:left; width: 180px; text-align:right; margin-right:10px;display:block;}
.createOptions .line .value { float:left; width: 200px; display:block;}
.createOptions .hrline { margin-top:5px;margin-bottom:5px; border-bottom: 1px dashed #ddd;}
.createOptions .lineErr { color:#e00; font: bold 14px Tahoma; padding:10px; border:1px dashed #f80000;display:block;}

.hrline { margin-top:5px;margin-bottom:5px; border-bottom: 1px dashed #ddd;}

.createForm { width:390px; border: 0px solid #aaa; padding:20px; background:#f9f9f9; margin:10px auto;}
.createForm form .line { width: 385px; display:block; border: 0px solid #000;}
.createForm form .line label { color:#464646; display:block; width:180px; border: 0px solid #000; float:left; font: normal 14px Arial, Helvetica, sans-serif; text-align:right; padding:6px;}
.createForm form .line input { display:block; float:left; width: 180px; margin-left:5px; padding:5px 2px; border:1px solid #c0c0c0; font: normal 14px Arial, Helvetica, sans-serif;}
.createForm form .lineSubmit { width:385px; text-align:center; border: 0px solid #000; border-top: 1px dashed #000; margin-top:5px;}
.createForm form .lineSubmit input { background:none;width: 120px; margin-left:0px; padding:5px 2px; border:0px solid #c0c0c0; font: bold 14px Arial, Helvetica, sans-serif; color:#4aaede; cursor:pointer; margin-top:5px;}
.createForm form .lineSubmit input:hover { text-decoration:underline; }
.createForm form .lineAuthErr { width:320px; text-align:center; border: 0px solid #000; border-bottom: 1px dashed #000; margin:5px; color:#f00; font: bold 14px Arial, Helvetica, sans-serif; padding-bottom:5px;}

.s_title { text-align:center; font: bold 21px Arial; color:#1d9ad6; padding-bottom:5px; border-bottom: 1px dashed #e0e0e0; margin-bottom:5px;}

.ss_info { font: normal 11px Tahoma; }
.ss_info .title { font: bold 14px Tahoma; }

.ss_info ul { font: normal 11px Tahoma; }
.ss_info ul li { list-style-type: none; background: url(/cabinet/images/arrowbullet.png) no-repeat center left; padding-left: 20px; margin:5px 0;}

.ss_info .cnt { text-align:center; margin-top:60px; font: normal 14px Tahoma; }
#sw { margin:10px auto; display:block; width:95px; height:28px;}
#sw img { margin:0; padding:0; }

.sms_form { margin:25px; font:13px normal Arial;}
.sms_form .container { margin:auto; }
.errmsg { color:#ff0000; }
.sms_form .sms_form_resize { width:350px; border:0px solid #000; text-align:center; margin:auto;}
.sms_form .sms_form_resize label { float:left; padding-top:4px; }
.sms_form .sms_form_resize .plus7 { float:left; margin-left:10px; margin-right:10px; font:bold 13px Tahoma; padding-top:4px;}
.sms_form .sms_form_resize select { float:left; font:bold 13px Tahoma; }
.sms_form .sms_form_resize input { float:left; font:bold 13px Tahoma; }
.sms_form .sms_form_resize input[type=submit] { float:none; font:normal 13px Arial; }

.sms_ph_info { font:13px normal Arial; margin-left:25px; }
<?php }} ?>