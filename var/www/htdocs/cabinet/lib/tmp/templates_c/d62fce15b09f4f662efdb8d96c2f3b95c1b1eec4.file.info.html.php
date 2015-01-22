<?php /* Smarty version Smarty-3.1.7, created on 2012-02-14 15:37:03
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/info.html" */ ?>
<?php /*%%SmartyHeaderCode:11565942874f3a475f793a11-78914643%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd62fce15b09f4f662efdb8d96c2f3b95c1b1eec4' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/info.html',
      1 => 1328780746,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11565942874f3a475f793a11-78914643',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ABONENT' => 0,
    'ACCOUNT_STATUS' => 0,
    'ACCOUNT_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3a475f91941',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3a475f91941')) {function content_4f3a475f91941($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/opt/ipoev2/var/www/htdocs/cabinet/lib/smarty/plugins/modifier.date_format.php';
?><div class="infoBlock">
    <div class="title"><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["FullName"];?>
</div>
    <div class="clr"></div>
    <div class="line"><label>Баланс лицевого счёта:</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["Balance"];?>
 руб.</span></div>
    <div class="clr"></div>
    <div class="line"><label>Номер договора:</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["ContractNumber"];?>
 от <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ABONENT']->value["ContractDate"],"%e %b %Y");?>
</span></div>
    <div class="clr"></div>
    <div class="line"><label>Активная учётная запись:</label><span<?php if ($_smarty_tpl->tpl_vars['ACCOUNT_STATUS']->value==0){?> class="on"<?php }else{ ?> class="off"<?php }?>><?php echo $_smarty_tpl->tpl_vars['ACCOUNT_NAME']->value;?>
 (<?php if ($_smarty_tpl->tpl_vars['ACCOUNT_STATUS']->value==0){?>Включена<?php }else{ ?>Отключена<?php }?>)</span></div>
    <div class="clr"></div>
</div>
<div class="infoSpacer"></div>
<div class="infoBlock">
    <div class="title">Реквизиты</div>
    <div class="clr"></div>
    <div class="line"><label>E-Mail:</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["Email"];?>
</span></div><div class="clr"></div>
    <div class="line"><label>Тип абонента:</label><span><?php if ($_smarty_tpl->tpl_vars['ABONENT']->value["PrivatePerson"]==1){?>Физическое лицо<?php }else{ ?>Юридическое лицо<?php }?></span></div><div class="clr"></div>
    <div class="line"><label>Адрес:</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["OfficialAddress"];?>
</span></div><div class="clr"></div>
<?php if ($_smarty_tpl->tpl_vars['ABONENT']->value["PrivatePerson"]==1){?>
    <div class="line"><label>Паспортные данные:</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["PassportSerie"];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["PassportNumber"];?>
</span></div><div class="clr"></div>
    <div class="line"><label>Паспорт выдан:</label><span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ABONENT']->value["PassportGivenDate"],"%e %b %Y");?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["PassportGiven"];?>
</span></div><div class="clr"></div>
<?php }else{ ?>    
    <div class="line"><label>ИНН:</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["Inn"];?>
</span></div><div class="clr"></div>
    <div class="line"><label>Банк:</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["Bank"];?>
</span></div><div class="clr"></div>
    <div class="line"><label>Р/С</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["RS"];?>
</span></div><div class="clr"></div>
    <div class="line"><label>К/С</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["KS"];?>
</span></div><div class="clr"></div>
    <div class="line"><label>БИК</label><span><?php echo $_smarty_tpl->tpl_vars['ABONENT']->value["Bik"];?>
</span></div><div class="clr"></div>
<?php }?>
    <div class="infoline"><b>Внимание!</b> Если вы заметили не правильные данные, <br />либо они изменились с момента заключения договора, <br />сообщите об этом нам.</div>
</div><?php }} ?>