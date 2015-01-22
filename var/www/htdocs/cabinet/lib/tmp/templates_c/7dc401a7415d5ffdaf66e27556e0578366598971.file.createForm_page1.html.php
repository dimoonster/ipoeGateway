<?php /* Smarty version Smarty-3.1.7, created on 2012-02-13 18:39:19
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/createForm_page1.html" */ ?>
<?php /*%%SmartyHeaderCode:5989398534f391fa515e8d0-80197520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7dc401a7415d5ffdaf66e27556e0578366598971' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/createForm_page1.html',
      1 => 1329143957,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5989398534f391fa515e8d0-80197520',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f391fa5252de',
  'variables' => 
  array (
    'index' => 0,
    'P1ARR' => 0,
    'TOTAL_COST' => 0,
    'TOTAL_SPEED' => 0,
    'ERR_STR' => 0,
    'BASE_URL' => 0,
    'SERVICE_URL' => 0,
    'AJAX' => 0,
    'TRF_DATA' => 0,
    'TRF_NAME' => 0,
    'TRF_DESCR' => 0,
    'TRF_SHARED' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f391fa5252de')) {function content_4f391fa5252de($_smarty_tpl) {?><div style="height:400px">
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

	<div class="lineErr" <?php if ($_smarty_tpl->tpl_vars['ERR_STR']->value==''){?>style="display:none"<?php }?>><?php echo $_smarty_tpl->tpl_vars['ERR_STR']->value;?>
</div>
	<div class="clr"></div>
	
	<div class="createForm">
	<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['SERVICE_URL']->value;?>
&createForm<?php echo $_smarty_tpl->tpl_vars['AJAX']->value;?>
&page2" id="createTariff" name="createTariff">
	
	<input type="hidden" name="trfdata" value="<?php echo $_smarty_tpl->tpl_vars['TRF_DATA']->value;?>
" />
	
	<div class="line"><label>Введите название тарифа:</label><input class="text" type="text" name="tname" value="<?php echo $_smarty_tpl->tpl_vars['TRF_NAME']->value;?>
" /></div>
	<div class="clr"></div>
	<div class="line"><label>Введите описание тарифа:</label><input class="text" type="text" name="tdescr" value="<?php echo $_smarty_tpl->tpl_vars['TRF_DESCR']->value;?>
" /></div>
	<div class="clr"></div>
	<div class="line"><label>Поделиться тарифом:</label><input class="text" type="checkbox" name="tshare" value="1"<?php if ($_smarty_tpl->tpl_vars['TRF_SHARED']->value!=0){?> checked<?php }?> /></div>
	<div class="clr"></div>
	<div class="lineSubmit"><input type="submit" value="Создать тариф" /></div>
	</form>
	</div>
    </div>
</div>

<script>
$('#createTariff').ajaxForm({ target: '#ajaxContent' });
</script>
<?php }} ?>