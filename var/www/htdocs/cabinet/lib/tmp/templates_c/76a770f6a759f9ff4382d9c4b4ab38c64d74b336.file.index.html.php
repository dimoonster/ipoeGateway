<?php /* Smarty version Smarty-3.1.7, created on 2012-02-15 17:23:11
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/index.html" */ ?>
<?php /*%%SmartyHeaderCode:19698572054f391fb3545429-12607469%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76a770f6a759f9ff4382d9c4b4ab38c64d74b336' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/index.html',
      1 => 1329312186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19698572054f391fb3545429-12607469',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f391fb35e61d',
  'variables' => 
  array (
    'ACCOUNT_NAME' => 0,
    'CURRENT_TARIFF_TITLE' => 0,
    'CURRENT_TARIFF_COST' => 0,
    'NEXT_TARIFF_TITLE' => 0,
    'NEXT_TARIFF_COST' => 0,
    'CURRENT_TARIFF_DATE' => 0,
    'SERVICE_URL' => 0,
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f391fb35e61d')) {function content_4f391fb35e61d($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/opt/ipoev2/var/www/htdocs/cabinet/lib/smarty/plugins/modifier.date_format.php';
?>
<div class="infoBlock">
    <div class="title">Учётная запись: <?php echo $_smarty_tpl->tpl_vars['ACCOUNT_NAME']->value;?>
</div><div class="clr"></div>
    <div class="line"><label>Текущий тариф:</label><span><?php echo $_smarty_tpl->tpl_vars['CURRENT_TARIFF_TITLE']->value;?>
</span></div><div class="clr"></div>
    <div class="line"><label>Абонентная плата:</label><span><?php echo $_smarty_tpl->tpl_vars['CURRENT_TARIFF_COST']->value;?>
 руб.</span></div><div class="clr"></div>
    <div class="spacer"></div><div class="clr"></div>
    <div class="line"><label>Тариф на следующий месяц:</label><span><?php echo $_smarty_tpl->tpl_vars['NEXT_TARIFF_TITLE']->value;?>
</span></div><div class="clr"></div>
    <div class="line"><label>Абонентная плата:</label><span><?php echo $_smarty_tpl->tpl_vars['NEXT_TARIFF_COST']->value;?>
 руб.</span></div><div class="clr"></div>
    <div class="spacer"></div><div class="clr"></div>
    <div class="line"><label>Дата следующего списания:</label><span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['CURRENT_TARIFF_DATE']->value,"%d %b %Y");?>
</span></div><div class="clr"></div>

</div>

<div class="infoSpacer">
<div class="infoText">Смена тарифа:</div>
<div class="clr"></div>

<div class="infoBlock2">
    <div class="title">Мои тарифы (<a id="createForm" name="createForm" href="<?php echo $_smarty_tpl->tpl_vars['SERVICE_URL']->value;?>
&ajax&createForm">создать свой тариф</a>)</div><div class="clr"></div>
    
    <div class="list" rel="my">
    </div>
</div>

<div class="infoBlock2">
    <div class="title">Тарифы абонентов</div><div class="clr"></div>
    <div class="list" rel="shared">
    </div>
</div>

<div class="infoBlock2">
    <div class="title">Наши тарифы</div><div class="clr"></div>
    
    <div class="list" rel="operator">
    </div>
</div>

<script>
$("#createForm").click(function(){ $(".infoBlock2").each( function() { if($('.list', this).css('display') != 'none') $('.title', this).click(); });$("#ajaxContainer").css({ position: 'absolute',display: 'block',left: 0, top: 200, border: '0px solid #000',width: '100%'});$("#ajaxContent").load($(this).attr('href'));return false;});
$(".infoBlock2").each(function(){ var shown=false;var trigger=$('.title', this);var info=$('.list',this);$(trigger).click(function(){ if(shown){ shown=false;info.hide('slow');info.html('&nbsp;'); } else { info.slideDown("slow");shown=true;taddr="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['SERVICE_URL']->value;?>
&ajax&getlist="+info.attr("rel");info.load(taddr);};});});
</script><?php }} ?>