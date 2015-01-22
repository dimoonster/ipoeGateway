<?php /* Smarty version Smarty-3.1.7, created on 2012-02-13 19:17:20
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/createForm_page2.html" */ ?>
<?php /*%%SmartyHeaderCode:10479063654f392926713b40-86255042%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f34b65884e79128050e392a9f99f99e7e4e78754' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/createForm_page2.html',
      1 => 1329146228,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10479063654f392926713b40-86255042',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3929267e13a',
  'variables' => 
  array (
    'index' => 0,
    'P1ARR' => 0,
    'TOTAL_COST' => 0,
    'TOTAL_SPEED' => 0,
    'TRF_NAME' => 0,
    'TRF_DESCR' => 0,
    'TRF_SHARED' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3929267e13a')) {function content_4f3929267e13a($_smarty_tpl) {?><div style="height:400px">
    <div class="speedList">
	<div class="title">
	    <div class="titleTime">Время</div>
	    <div class="titleSpeed">Скорость</div>
	    <div class="titleCost">Стоимость</div>
	    <div class="clr"></div>
	</div>
	<div class="data">
<?php $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int)ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? 23+1 - (0) : 0-(23)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0){
for ($_smarty_tpl->tpl_vars['index']->value = 0, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++){
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration == 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration == $_smarty_tpl->tpl_vars['index']->total;?>
	<div class="line">
	    <div class="elem1"><?php echo $_smarty_tpl->tpl_vars['P1ARR']->value[$_smarty_tpl->tpl_vars['index']->value]["time"];?>
</div>
	    <div class="elem2"><?php echo $_smarty_tpl->tpl_vars['P1ARR']->value[$_smarty_tpl->tpl_vars['index']->value]["speed"];?>
 Мбит/с</div>
	    <div class="elem3"><?php echo $_smarty_tpl->tpl_vars['P1ARR']->value[$_smarty_tpl->tpl_vars['index']->value]["cost"];?>
 руб.</div>
	    <div class="clr"></div>
	</div>
<?php }} ?>
	</div>
    </div>
    <div class="createOptions">
	<div class="title">Информация о тарифе</div>

	<div class="line"><div class="label">Абонентная плата:</div><div class="value"><?php echo $_smarty_tpl->tpl_vars['TOTAL_COST']->value;?>
 руб.</div></div>
	<div class="clr"></div>
	<div class="line"><div class="label">Среднесуточная скорость:</div><div class="value"><?php echo $_smarty_tpl->tpl_vars['TOTAL_SPEED']->value;?>
 Мбит/с</div></div>
	<div class="clr"></div>
	
	<div class="line"><div class="label">Название тарифа:</div><div class="value"><?php echo $_smarty_tpl->tpl_vars['TRF_NAME']->value;?>
</div></div><div class="clr"></div>
	<div class="line"><div class="label">Описание тарифа:</div><div class="value"><?php echo $_smarty_tpl->tpl_vars['TRF_DESCR']->value;?>
</div></div><div class="clr"></div>
	<div class="line"><div class="label">Тариф доступен:</div><div class="value"><?php if ($_smarty_tpl->tpl_vars['TRF_SHARED']->value==1){?>всем<?php }else{ ?>только мне<?php }?></div></div><div class="clr"></div>

	<div class="line">Тариф был успешно создан. Теперь вы можете закрыть это окно и выбрать его в списке "Мои тарифы"</div>
    </div>
</div>

<script>
$('#createTariff').ajaxForm({ target: '#ajaxContent' });
</script>
<?php }} ?>