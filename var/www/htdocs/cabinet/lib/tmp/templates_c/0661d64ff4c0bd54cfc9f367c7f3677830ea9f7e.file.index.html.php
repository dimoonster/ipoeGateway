<?php /* Smarty version Smarty-3.1.7, created on 2012-02-21 12:18:31
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/start.stop/index.html" */ ?>
<?php /*%%SmartyHeaderCode:5766344314f3e6db87dae05-66906520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0661d64ff4c0bd54cfc9f367c7f3677830ea9f7e' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/start.stop/index.html',
      1 => 1329812308,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5766344314f3e6db87dae05-66906520',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3e6db88213e',
  'variables' => 
  array (
    'ACCOUNT_NAME' => 0,
    'STATUS_TEXT' => 0,
    'ACC_STAT_ONOFF' => 0,
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3e6db88213e')) {function content_4f3e6db88213e($_smarty_tpl) {?><div class="s_title">Услуга: приостановка обслуживания</div>
<div class="ss_info">
  <span class="title">Правила пользования и описание услуги</span>
  <ul>
    <li>Услуга позволяет производить временную блокировку учётной записи.</li>
    <li>Услуга предоставляется бесплатно.</li>
    <li>Воспользоваться услугой можно только один раз в течении текущего месяца.</li>
    <li>День подачи электронной заявки на временную приостановку обслуживания считается первым днем предоставления услуги и учитывается при перерасчете.</li>
    <li>День подачи электронной заявки на отказ от услуги и возобновление обслуживания при перерасчете не учитывается.</li>
    <li>В случае, когда заявки на подключение и на отказ от услуги временной приостановки обслуживания были поданы в течение одних суток, перерасчет не производится.</li>
    <li>Срок использования услуги Абонент определяет самостоятельно. Абонент в любой момент может самостоятельно возобновить обслуживание, отказавшись от услуги. После отказа Оператор восстановит обслуживание в течение одного часа.</li>
    <li>Максимально возможный период пользования услугой временной приостановки обслуживания ограничивается сроком действия Договора с данным Абонентом. На время пользования услугой Оператор сохраняет за Абонентом предоставляемые в соответствии с Договором ресурсы, включая Линию Связи. </li>
  </ul>
  
  <div class="cnt">Учётная запись <b><?php echo $_smarty_tpl->tpl_vars['ACCOUNT_NAME']->value;?>
</b> <div id="sw" name="sw"></div><div id="swresult" name="swresult"><?php echo $_smarty_tpl->tpl_vars['STATUS_TEXT']->value;?>
</div></div>
</div>

<script>
$("#sw").iphoneSwitch("<?php echo $_smarty_tpl->tpl_vars['ACC_STAT_ONOFF']->value;?>
",
function() { $("#sw").attr('disabled', 'disabled');$('#swresult').load('<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?services&start.stop&ajax&start');$("#sw").attr('disabled', 'disabled'); },
function() { $("#sw").attr('disabled', 'disabled');$('#swresult').load('<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?services&start.stop&ajax&stop');$("#sw").attr('disabled', 'disabled'); },
{
    switch_on_container_path: '<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/iphone/iphone_switch_container_on.png',
    switch_off_container_path: '<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/iphone/iphone_switch_container_off.png',
    switch_path: '<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/iphone/iphone_switch.png'
}
);
</script><?php }} ?>