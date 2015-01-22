<?php /* Smarty version Smarty-3.1.7, created on 2012-03-05 19:25:25
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/sms/apr.html" */ ?>
<?php /*%%SmartyHeaderCode:4264344454f54dac6a6f506-17357445%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c3f122624116e1ad6f08cc7c39494666d7ff996' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/sms/apr.html',
      1 => 1330961122,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4264344454f54dac6a6f506-17357445',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f54dac6ac51a',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f54dac6ac51a')) {function content_4f54dac6ac51a($_smarty_tpl) {?><div>На указанный номер отправлена SMS с кодом подтверждения. Введите пришедший код и нажмите кнопку "Отправить".</div>

<div class="sms_form">
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?services&sms&phupdate">
<label>Введите код подтверждения:</label>
<input type="text" name="apr_code" value="" />
<input type="submit" value="Отправить" />
</form>
</div><?php }} ?>