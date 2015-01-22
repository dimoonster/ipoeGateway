<?php /* Smarty version Smarty-3.1.7, created on 2012-02-17 17:24:56
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/chooseTariff_result.html" */ ?>
<?php /*%%SmartyHeaderCode:18922301334f3d2be56c2f36-46957168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a145b291851200e975797484f3918c7827d1d0f1' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/chooseTariff_result.html',
      1 => 1329485081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18922301334f3d2be56c2f36-46957168',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3d2be5792aa',
  'variables' => 
  array (
    'TARIFF' => 0,
    'OPERATOR' => 0,
    'index' => 0,
    'P1ARR' => 0,
    'TOTAL_COST' => 0,
    'TOTAL_SPEED' => 0,
    'RESULT' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3d2be5792aa')) {function content_4f3d2be5792aa($_smarty_tpl) {?><style>
.choose { width:900px; height:400px;}
.choose .ctitle { font: bold 14px Tahoma; text-align:center; padding-bottom:4px; border-bottom:1px dashed #aaaaaa;}
</style>

<div class="choose">
    <div class="ctitle">Тариф <?php echo $_smarty_tpl->tpl_vars['TARIFF']->value["name"];?>
</div>
    <div class="clr"></div>

    <div class="speedList">
	<div class="title">
	    <div class="titleTime">Время</div>
	    <div class="titleSpeed">Скорость</div>
	    <?php if ($_smarty_tpl->tpl_vars['OPERATOR']->value==''){?><div class="titleCost">Стоимость</div><?php }?>
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
		<?php if ($_smarty_tpl->tpl_vars['OPERATOR']->value==''){?><div class="elem3"><?php echo $_smarty_tpl->tpl_vars['P1ARR']->value[$_smarty_tpl->tpl_vars['index']->value]["cost"];?>
 руб.</div><?php }?>
		<div class="clr"></div>
	    </div>
    <?php }} ?>
	</div>
    </div>

    <div class="createOptions">
        <div class="title">Информация о тарифе</div>
        
        <div class="linedescr">Описание: <em><?php echo $_smarty_tpl->tpl_vars['TARIFF']->value["descr"];?>
</em></div>

        <div class="line"><div class="label">Абонентная плата:</div><div class="value"><?php if ($_smarty_tpl->tpl_vars['OPERATOR']->value==''){?><?php echo $_smarty_tpl->tpl_vars['TOTAL_COST']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['TARIFF']->value["cost"];?>
<?php }?> руб.</div></div>
        <div class="clr"></div>
        <div class="line"><div class="label">Среднесуточная скорость:</div><div class="value"><?php echo $_smarty_tpl->tpl_vars['TOTAL_SPEED']->value;?>
 Мбит/с</div></div>
        <div class="clr"></div>
        <div class="hrline"></div>
        <div class="clr"></div>
        <div class="cline" style="font: bold 14px Arial;"><?php echo $_smarty_tpl->tpl_vars['RESULT']->value;?>
</div>

    </div>
</div><?php }} ?>