<?php /* Smarty version Smarty-3.1.7, created on 2012-03-05 19:15:23
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/sms/index.html" */ ?>
<?php /*%%SmartyHeaderCode:20467972964f435993e99eb7-94592129%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7271b76df7b837cb68129ac9519ab01ab88cf451' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/sms/index.html',
      1 => 1330960265,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20467972964f435993e99eb7-94592129',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f435993f23e9',
  'variables' => 
  array (
    'USER_PHONE' => 0,
    'USER_PHONE_WRONG' => 0,
    'BASE_URL' => 0,
    'MOBILE_CODES' => 0,
    'code' => 0,
    'USER_PHONE_CODE' => 0,
    'USER_PHONE_NUM' => 0,
    'STATUS_TEXT' => 0,
    'STATUS' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f435993f23e9')) {function content_4f435993f23e9($_smarty_tpl) {?><div class="s_title">Услуга: SMS Уведомления</div>
<div class="ss_info">
  <span class="title">Правила пользования и описание услуги</span>
  <ul>
    <li>Услуга "SMS уведомления" служит для отсылки посредством SMS уведомлений: о необходимости пополнить лицевой счет, о проводимых акциях, о работах и авариях на сети, о подтверждении действий абонента в личном кабинете</li>
    <li>SMS о пополнении лицевого счёта отсылается не ранее чем за 3 суток до окончания текущего отчетного периода, если на лицевом счете пользователя находится сумма, недостаточная для активации тарифного плана</li>
    <li>В сообщении указывается номер договора и сумма, на которую небходимо пополнить лицевой счет</li>
    <li>Для включения услуги пользователь должен указать федеральный номер сотового телефона и временной промежуток суток, в который он желает получать SMS уведомления о необходимости пополнить лицевой счёт.</li>
    <li>Услуга предоставляется бесплатно</li>
  </ul>
</div>

<div class="hrline"></div>
<div class="sms_ph_info">Вами был указан номер телефона: <?php echo $_smarty_tpl->tpl_vars['USER_PHONE']->value;?>
</div>

<?php if ($_smarty_tpl->tpl_vars['USER_PHONE_WRONG']->value==1){?>
<div class="sms_ph_info errmsg">На указанный телефон доставка SMS не возможна!</div>
<?php }?>

<div class="sms_form">
<div class="sms_form_resize">
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?services&sms&phupdate">
<div class="container"><label>Введите номер мобильного телефона:</label></div>
<div class="clr"></div>
<span class="plus7">+7</span>
<select name="code" style="code">
<?php  $_smarty_tpl->tpl_vars['code'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['code']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MOBILE_CODES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['code']->key => $_smarty_tpl->tpl_vars['code']->value){
$_smarty_tpl->tpl_vars['code']->_loop = true;
?>
    <option value="<?php echo $_smarty_tpl->tpl_vars['code']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['code']->value==$_smarty_tpl->tpl_vars['USER_PHONE_CODE']->value){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['code']->value;?>
</option>
<?php } ?>
</select>
<input type="text" name="number" id="number" name="number" value="<?php echo $_smarty_tpl->tpl_vars['USER_PHONE_NUM']->value;?>
" /><div class="errmsg" id="errmsg" name="errmsg"></div>
<input id="sms_f_submit" type="submit" value="Обновить номер телефона" />
</form>
</div>
</div>

<div class="hrline"></div>

<div style="">
<div id="sw" name="sw"></div>
<div id="swresult" name="swresult" style="margin:auto;width:200px;text-align:center;font:bold 14px Arial;"><?php echo $_smarty_tpl->tpl_vars['STATUS_TEXT']->value;?>
</div>
</div>

<script>
$("#number").keypress(function (e) { 
    //Если символ - не цифра, ввыодится сообщение об ошибке, другие символы не пишутся
    if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
          //Вывод сообщения об ошибке
        $("#errmsg").html("Только цифры").show().delay(800).fadeOut("slow"); 
        return false;
    }
    
    if($(this).attr("value").length >= 7) {
//        $("#errmsg").html("не больше 7 цифр").show().delay(800).fadeOut("slow"); 
        return false;
    }
});

$("#sms_f_submit").button();

$("#sw").iphoneSwitch("<?php echo $_smarty_tpl->tpl_vars['STATUS']->value;?>
",
function() { $("#sw").attr('disabled', 'disabled');$('#swresult').load('<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?services&sms&ajax&start');$("#sw").attr('disabled', 'disabled'); },
function() { $("#sw").attr('disabled', 'disabled');$('#swresult').load('<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
?services&sms&ajax&stop');$("#sw").attr('disabled', 'disabled'); },
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