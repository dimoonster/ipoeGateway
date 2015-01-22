<?php /* Smarty version Smarty-3.1.7, created on 2012-02-13 18:56:56
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services_index.html" */ ?>
<?php /*%%SmartyHeaderCode:19944162474f3924b894d8b7-34076276%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b57bd04cee838ed931d8b9994eed844aed566e6' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services_index.html',
      1 => 1328870085,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19944162474f3924b894d8b7-34076276',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BASE_URL' => 0,
    'CURRENT_MAIN_MENU_POSITION' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3924b8a107d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3924b8a107d')) {function content_4f3924b8a107d($_smarty_tpl) {?><div class="bubbleInfo">
    <div class="icon"><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['CURRENT_MAIN_MENU_POSITION']->value;?>
&turbo.button"><img class="trigger" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/icons/28.png" /></a><p class="info">ТУРБО.Кнопка</p></div>
</div>

<div class="bubbleInfo">
    <div class="icon"><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['CURRENT_MAIN_MENU_POSITION']->value;?>
&sms"><img class="trigger" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/icons/19.png" /></a><p class="info clr">SMS Уведомления</p></div>
</div>

<div class="bubbleInfo">
    <div class="icon"><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['CURRENT_MAIN_MENU_POSITION']->value;?>
&my.tariff"><img class="trigger" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/icons/18.png" /></a><p class="info">Мой.Тариф</p></div>
</div>

<div class="bubbleInfo">
    <div class="icon"><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['CURRENT_MAIN_MENU_POSITION']->value;?>
&start.stop"><img class="trigger" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/icons/27.png" /></a><p class="info">Приостановка обслуживания</p></div>
</div>

<div class="bubbleInfo">
    <div class="icon"><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['CURRENT_MAIN_MENU_POSITION']->value;?>
&trial.pay"><img class="trigger" src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/icons/30.png" /></a><p class="info">Обещанный платёж</p></div>
</div>

<div class="clr"></div>

<?php }} ?>