<?php /* Smarty version Smarty-3.1.7, created on 2012-02-17 17:28:16
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/chooseTariff.html" */ ?>
<?php /*%%SmartyHeaderCode:19136788674f3cbbfe6aa525-87309943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9940d9d0fb5effd61eabb70bf3263cd2438275d2' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/chooseTariff.html',
      1 => 1329485293,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19136788674f3cbbfe6aa525-87309943',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3cbbfe6abca',
  'variables' => 
  array (
    'TARIFF' => 0,
    'OPERATOR' => 0,
    'index' => 0,
    'P1ARR' => 0,
    'TOTAL_COST' => 0,
    'TOTAL_SPEED' => 0,
    'CURRENT_TARIFF_DATE' => 0,
    'ACCOUNT_NAME' => 0,
    'MINIMAL_COST' => 0,
    'BASE_URL' => 0,
    'SERVICE_URL' => 0,
    'AJAX' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3cbbfe6abca')) {function content_4f3cbbfe6abca($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/opt/ipoev2/var/www/htdocs/cabinet/lib/smarty/plugins/modifier.date_format.php';
?><style>
.choose { width:900px; height:400px;}
.choose .ctitle { font: bold 14px Tahoma; text-align:center; padding-bottom:4px; border-bottom:1px dashed #aaaaaa;}
.cline a { color:#1d9ad6; text-decoration:none; font-weight:bold;}
.cline a:hover { text-decoration:underline; }
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
        <div class="line">Нажимая на кнопку "Активировать тариф", я соглашаюсь с тем, что начиная с <b><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['CURRENT_TARIFF_DATE']->value,"%d %b %Y");?>
</b> на учётной записи <b><?php echo $_smarty_tpl->tpl_vars['ACCOUNT_NAME']->value;?>
</b> доступ в сеть Интернет мне будет предоставляться в соответствии с параметрами указанными в таблице в левой части данного окна и абонентная плата составит <b><?php if ($_smarty_tpl->tpl_vars['OPERATOR']->value==''){?><?php echo $_smarty_tpl->tpl_vars['TOTAL_COST']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['TARIFF']->value["cost"];?>
<?php }?></b> руб. <?php if ($_smarty_tpl->tpl_vars['OPERATOR']->value==''){?><small>(Абонентная плата формируется из: Абонентной платы за услугу "Мой.Тариф" в размере <?php echo $_smarty_tpl->tpl_vars['MINIMAL_COST']->value;?>
 рублей и суммарной оплаты за доступ в сеть интернет в размере <?php echo $_smarty_tpl->tpl_vars['TOTAL_COST']->value-$_smarty_tpl->tpl_vars['MINIMAL_COST']->value;?>
 рублей)</small><?php }?></div>
        <div class="hrline"></div>
        <div class="clr"></div>
        <div class="cline"><a id="aconfirm" name="aconfirm" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['SERVICE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['AJAX']->value;?>
<?php echo $_smarty_tpl->tpl_vars['OPERATOR']->value;?>
&choose=<?php echo $_smarty_tpl->tpl_vars['TARIFF']->value["id"];?>
&confirm">Активировать тариф</a></div>

    </div>
</div>

<script>
$("#aconfirm").click(function () {
    $("#ajaxContent").load($(this).attr('href'));
    return false;
});
</script><?php }} ?>