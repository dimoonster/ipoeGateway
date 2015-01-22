<?php /* Smarty version Smarty-3.1.7, created on 2012-02-14 15:36:34
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/pay.html" */ ?>
<?php /*%%SmartyHeaderCode:13375963814f3a4742ea1d49-79024522%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f76115e993904082a3004d2aac763db7ba779347' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/pay.html',
      1 => 1328790990,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13375963814f3a4742ea1d49-79024522',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PAYLIST' => 0,
    'pay' => 0,
    'BASE_URL' => 0,
    'DEBETS' => 0,
    'debet' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3a47430991d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3a47430991d')) {function content_4f3a47430991d($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/opt/ipoev2/var/www/htdocs/cabinet/lib/smarty/plugins/modifier.date_format.php';
?><div class="infoBlock">
    <div class="title">История платежей</div><div class="clr"></div>
    
    <table border="0" cellpadding="0" cellspacing="1" class="tablesorter" id="pays" name="pays">
    <thead>
	<th>Дата платежа</th>
	<th>Сумма платежа</th>
	<th>Место платежа</th>
    </thead>
    <tbody>
<?php  $_smarty_tpl->tpl_vars['pay'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pay']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['PAYLIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pay']->key => $_smarty_tpl->tpl_vars['pay']->value){
$_smarty_tpl->tpl_vars['pay']->_loop = true;
?>
	<tr>
	    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['pay']->value["PayDate"],"%Y/%m/%d");?>
</td>
	    <td><?php echo $_smarty_tpl->tpl_vars['pay']->value["SumInRubles"];?>
</td>
	    <td><?php echo $_smarty_tpl->tpl_vars['pay']->value["PaySource"];?>
</td>
	</tr>
<?php } ?>
    </tbody>
    </table>
    
    <div class="clr"></div>
    
    <div style="height:20px;">
    
    <div id="pager" class="pager">
    <form onSubmit="">
            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/first.png" class="first"/>
            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/prev.png" class="prev"/>
            <input type="text" class="pagedisplay" readonly />
            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/next.png" class="next"/>
            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/last.png" class="last"/>
            <select class="pagesize">
                <option value="5">5</option>
                <option selected="selected"  value="10">10</option>
                <option value="15">15</option>
            </select>
    </form>
    </div>
    
    </div>
    
    <script>
	$("#pays")
	    .tablesorter( { sortList: [[0,1]] } )
	    .tablesorterPager( { container: $("#pager") } );
    </script>
</div>

<div class="infoSpacer"></div>

<div class="infoBlock">
    <div class="title">История списаний</div><div class="clr"></div>

    <table border="0" cellpadding="0" cellspacing="1" class="tablesorter" id="debets" name="debets">
    <thead>
	<th>Дата</th>
	<th>Сумма</th>
	<th>Учётная запись</th>
	<th>Тариф</th>
    </thead>
    <tbody>
<?php  $_smarty_tpl->tpl_vars['debet'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['debet']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DEBETS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['debet']->key => $_smarty_tpl->tpl_vars['debet']->value){
$_smarty_tpl->tpl_vars['debet']->_loop = true;
?>
	<tr>
	    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['debet']->value["Date"],"%Y/%m/%d");?>
</td>
	    <td><?php echo $_smarty_tpl->tpl_vars['debet']->value["Cost"];?>
</td>
	    <td><?php echo $_smarty_tpl->tpl_vars['debet']->value["Account"];?>
</td>
	    <td><?php echo $_smarty_tpl->tpl_vars['debet']->value["Tariff"];?>
</td>
	</tr>
<?php } ?>
    </tbody>
    </table>
    
    <div class="clr"></div>
    
    <div style="height:20px;">
    
    <div id="pagerDebets" class="pager">
    <form onSubmit="">
            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/first.png" class="first"/>
            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/prev.png" class="prev"/>
            <input type="text" class="pagedisplay" readonly />
            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/next.png" class="next"/>
            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/last.png" class="last"/>
            <select class="pagesize">
                <option value="5">5</option>
                <option selected="selected"  value="10">10</option>
                <option value="15">15</option>
            </select>
    </form>
    </div>
    
    </div>
    
    <script>
	$("#debets")
	    .tablesorter( { sortList: [[0,1]] } )
	    .tablesorterPager( { container: $("#pagerDebets") } );
    </script>
</div><?php }} ?>