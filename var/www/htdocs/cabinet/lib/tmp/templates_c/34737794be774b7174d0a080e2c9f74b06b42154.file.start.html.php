<?php /* Smarty version Smarty-3.1.7, created on 2012-02-20 17:53:18
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/start.stop/start.html" */ ?>
<?php /*%%SmartyHeaderCode:9249830524f42430d0a5440-41990814%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '34737794be774b7174d0a080e2c9f74b06b42154' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/start.stop/start.html',
      1 => 1329745995,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9249830524f42430d0a5440-41990814',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f42430d10435',
  'variables' => 
  array (
    'SW_ERR' => 0,
    'SERVICE_DATE' => 0,
    'ERR_STR' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f42430d10435')) {function content_4f42430d10435($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/opt/ipoev2/var/www/htdocs/cabinet/lib/smarty/plugins/modifier.date_format.php';
?><script>
    $("#sw").attr('disabled', '');
</script>
<?php if ($_smarty_tpl->tpl_vars['SW_ERR']->value==0){?>
<span style="font:bold 14px Tahoma">Услуга заказана с <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['SERVICE_DATE']->value,"%d %b %Y");?>
</span>
<?php }else{ ?>
<span style="font:bold 14px Tahoma;color:#dd0000;"><?php echo $_smarty_tpl->tpl_vars['ERR_STR']->value;?>
</span>
<script>
    $("#sw").html("").css({ height:"0px", width:"0px" });
</script>
<?php }?>
<?php }} ?>