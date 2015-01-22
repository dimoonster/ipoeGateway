<?php /* Smarty version Smarty-3.1.7, created on 2012-02-20 19:31:00
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/trial.pay/index.html" */ ?>
<?php /*%%SmartyHeaderCode:8222822244f4261a8ac0369-62080575%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '098048bb1c20d3e4f3e55c537a2d982b1ac86ef0' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/trial.pay/index.html',
      1 => 1329751843,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8222822244f4261a8ac0369-62080575',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f4261a8b487b',
  'variables' => 
  array (
    'ACC_STAT_ONOFF' => 0,
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f4261a8b487b')) {function content_4f4261a8b487b($_smarty_tpl) {?><div class="s_title">Услуга: обещанный платёж</div>
<div class="ss_info">
  <span class="title">Правила пользования и описание услуги</span>
  <ul>
    <li>Обещанный платеж – это услуга, позволяющая вам оперативно восстановить доступ к сети Интернет, даже если на счету закончились деньги, и нет возможности своевременно пополнить счет. Теперь Вы не зависите от обстоятельств и сами можете продлить срок оказания услуг на 5 календарных дней до внесения денежных средств.</li>
    <li>Услуга доступна всем абонентам</li>
    <li>Сумма «Обещанного платежа» автоматически устанавливается равной задолженности Абонента. Если сумма задолженности дробная, копейки округляются в большую сторону до целых рублей.</li>
    <li>Чтобы избежать повторного отключения, вам достаточно оплатить услугу доступа в Интернет в течение 5 дней, включая день активации услуги «Обещанный платеж».</li>
    <li>Вы можете активировать данную услугу не более 1 раза в месяц.</li>
    <li>Если обещанный платеж не погашен в течение 120 часов (5 суток), то происходит блокировка доступа в сеть и Интернет.</li>
    <li>Услуга «Обещанный платеж» не может быть использована, если предыдущий платеж не был погашен.</li>
  </ul>
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