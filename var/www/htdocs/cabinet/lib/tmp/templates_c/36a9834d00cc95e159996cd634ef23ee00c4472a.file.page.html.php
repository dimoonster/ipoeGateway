<?php /* Smarty version Smarty-3.1.7, created on 2012-02-20 16:32:32
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/page.html" */ ?>
<?php /*%%SmartyHeaderCode:8521884054f391fb362b809-15426739%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36a9834d00cc95e159996cd634ef23ee00c4472a' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/page.html',
      1 => 1329740508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8521884054f391fb362b809-15426739',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f391fb3768ae',
  'variables' => 
  array (
    'TITLE' => 0,
    'BASE_URL' => 0,
    'ACCOUNT_ACTIVE' => 0,
    'ACCOUNTS' => 0,
    'acc' => 0,
    'MAIN_MENU' => 0,
    'm_addr' => 0,
    'CURRENT_MAIN_MENU_POSITION' => 0,
    'm_title' => 0,
    'PAGE_DATA' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f391fb3768ae')) {function content_4f391fb3768ae($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>LUGLink.Net Member Area: <?php echo $_smarty_tpl->tpl_vars['TITLE']->value;?>
</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?css=style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?css=select.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?css=tablesorter.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/jquery.iphone-switch.js"></script>
    
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/jquery.tablesorter.pager.js"></script>

    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/cufon-yui.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/droid_sans_400-droid_sans_700.font.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/cuf_run.js"></script>

    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/myselect.js"></script>
</head>

<body>

<div id="ajaxContainer" name="ajaxContainer">
    <div class="ajaxContentBorder">
	<div class="close" id="ajaxClose" name="ajaxClose">Закрыть</div>
        <div id="ajaxContent" name="ajaxContent"></div>
    </div>
</div>


<div class="main">
<!-- Header -->
<div class="header">
    <div class="header_resize">
        <div class="logo"><h1><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
"><span>LUGLink</span>.Net<small>Personal member area</small></a></h1></div>
<?php if ($_smarty_tpl->tpl_vars['ACCOUNT_ACTIVE']->value>0){?>
        <div class="search">
            <form id="form1" name="form1" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?session&change_accid">
                <span>Учётная запись:
                    <select name="blogin" id="blogin">
<?php  $_smarty_tpl->tpl_vars['acc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['acc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ACCOUNTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['acc']->key => $_smarty_tpl->tpl_vars['acc']->value){
$_smarty_tpl->tpl_vars['acc']->_loop = true;
?>
			<option value="<?php echo $_smarty_tpl->tpl_vars['acc']->value["Number"];?>
"<?php if ($_smarty_tpl->tpl_vars['ACCOUNT_ACTIVE']->value==$_smarty_tpl->tpl_vars['acc']->value["Number"]){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['acc']->value["AccName"];?>
</option>
<?php } ?>
                    </select>
                </span>
            </form>
       </div>
<?php }?>
        <div class="clr"></div>

        <div class="menu">
            <ul>
<?php  $_smarty_tpl->tpl_vars['m_title'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m_title']->_loop = false;
 $_smarty_tpl->tpl_vars['m_addr'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MAIN_MENU']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m_title']->key => $_smarty_tpl->tpl_vars['m_title']->value){
$_smarty_tpl->tpl_vars['m_title']->_loop = true;
 $_smarty_tpl->tpl_vars['m_addr']->value = $_smarty_tpl->tpl_vars['m_title']->key;
?>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['m_addr']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['m_addr']->value==$_smarty_tpl->tpl_vars['CURRENT_MAIN_MENU_POSITION']->value){?> class="active"<?php }?>><span><?php echo $_smarty_tpl->tpl_vars['m_title']->value;?>
</span></a></li>
<?php } ?>
            </ul>
            <div class="clr"></div>
        </div>

        <div class="clr"></div>
    </div>
</div>
<!-- Header -->

<!-- Body -->
&nbsp;
<div class="body"><div class="body_resize">
<?php echo $_smarty_tpl->tpl_vars['PAGE_DATA']->value;?>

</div></div>
<!-- Body -->

<!-- Footer -->
    <div class="clr"></div>
    <div class="footer">
        <div class="footer_resize">
            <h3>&nbsp;</h3>
            <p>© МАОУДОД "ЦДОД "Компьютерный Центр"</p>
        </div>
        <div class="clr"></div>
    </div>
<!-- Footer -->

</div>

<script>
$("#ajaxClose").click(function() {
    $("#ajaxContent").html("");
    $("#ajaxContainer").css({
	display: 'none'
    });
});
</script>
</body>
</html><?php }} ?>