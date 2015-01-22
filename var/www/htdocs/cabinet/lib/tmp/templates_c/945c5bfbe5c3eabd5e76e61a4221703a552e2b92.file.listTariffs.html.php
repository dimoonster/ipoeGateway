<?php /* Smarty version Smarty-3.1.7, created on 2012-02-15 17:48:12
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/listTariffs.html" */ ?>
<?php /*%%SmartyHeaderCode:11931425474f392a52973fa4-40191002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '945c5bfbe5c3eabd5e76e61a4221703a552e2b92' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/listTariffs.html',
      1 => 1329313690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11931425474f392a52973fa4-40191002',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f392a529ae9c',
  'variables' => 
  array (
    'TRF_LIST' => 0,
    'i' => 0,
    'trf' => 0,
    'BASE_URL' => 0,
    'SERVICE_URL' => 0,
    'AJAX' => 0,
    'PAGINATOR' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f392a529ae9c')) {function content_4f392a529ae9c($_smarty_tpl) {?><style>
.trfline { height: 72px; padding:2px; border: 0px solid #000; position:relative; }
.trfline .info { float:left; width:570px; }
.trfline .info .trftitle { font: bold 14px Tahoma; padding-bottom: 2px; border-bottom: 1px dashed #aaa; }
.trfline .info .trftitle span { font: normal 10px Arial; }
.trfline .info .descr { font: normal 8px; margin: 1px; }

.trfline .image { float:left; width:220px; margin: 2px; padding:0px; border: 1px solid #afafaf; }
.trfline .image img { margin:0px; }

.trfline .buttons { float:right; width: 100px; text-align:center; margin-right: 4px;}
.trfline .buttons ul { margin:2px; padding:0px; }
.trfline .buttons ul li { display:block; list-style:none; padding: 2px; border: 1px solid #d9d9d9; background:#eee; margin:1px 0px 1px 0px;}
.trfline .buttons ul li a { text-decoration:none; color:#666; }

.trfline .popup { display:none; position:absolute; border:1px solid #eee;z-index:10;background:#fefefe; -webkit-box-shadow: 0 -0px 10px rgba(0,0,0,0.5);-moz-box-shadow: 0 0 10px rgba(0,0,0,0.5); box-shadow: 0 0 10px rgba(0,0,0,0.5); }
.tl0 { background: #f9f9f9; }

.paginator { display:block; margin-left:300px;}
</style>
<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
<?php  $_smarty_tpl->tpl_vars['trf'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['trf']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TRF_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['trf']->key => $_smarty_tpl->tpl_vars['trf']->value){
$_smarty_tpl->tpl_vars['trf']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['i']->value==0){?><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?><?php }?>
<div class="trfline tl<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">
    <div class="info">
	<div class="trftitle"><?php echo $_smarty_tpl->tpl_vars['trf']->value["name"];?>
<br /><span>(Средняя скорость: <b><?php echo $_smarty_tpl->tpl_vars['trf']->value["mspeed"];?>
 Мбит/с</b>; Стоимость в месяц: <b><?php echo $_smarty_tpl->tpl_vars['trf']->value["cost"];?>
 руб.</b>)</span></div>
	<div class="descr"><?php echo $_smarty_tpl->tpl_vars['trf']->value["descr"];?>
</div>
    </div>
    <div class="image">
	<img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
/images/tariffs/<?php echo $_smarty_tpl->tpl_vars['trf']->value["simg"];?>
" />
    </div>
    <div class="buttons">
	<ul>
	    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['SERVICE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['AJAX']->value;?>
&choose=<?php echo $_smarty_tpl->tpl_vars['trf']->value["id"];?>
">Выбрать тариф</a></li>
	    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['SERVICE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['AJAX']->value;?>
&createForm&base=<?php echo $_smarty_tpl->tpl_vars['trf']->value["id"];?>
">Создать свой на базе этого</a></li>
	</ul>
    </div>
    <div class="popup">
	<img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
/images/tariffs/<?php echo $_smarty_tpl->tpl_vars['trf']->value["bimg"];?>
" />
    </div>
</div>
<div class="clr"></div>
<?php } ?>

<?php if (0){?>
<div class="paginator">
    <a href="<?php echo $_smarty_tpl->tpl_vars['PAGINATOR']->value["prev"];?>
">Предидущая страница</a>&nbsp;|&nbsp;<a href="<?php echo $_smarty_tpl->tpl_vars['PAGINATOR']->value["next"];?>
">Следующая страница</a>
</div>
<?php }?>

<script>
$(".buttons a").click(function(){ 
    var oldhref = $("#createForm").attr('href');
    $("#createForm").attr('href', $(this).attr('href'));
    $("#createForm").click();
    $("#createForm").attr('href', oldhref);
    return false;
});


$(".trfline").each(function() { 
    var distance = 10;
    var time = 250;
    var hideDelay = 200;

    var hideDelayTimer = null;

    var beingShown = false;
    var shown = false;
    var trigger = $('.image', this);
    var info = $('.popup', this).css('opacity', 0);

    $([trigger.get(0), info.get(0)]).mouseover(function () {
        if (hideDelayTimer) clearTimeout(hideDelayTimer);
        if (beingShown || shown) {
            // don't trigger the animation again
            return;
        } else {
            // reset position of info box
            beingShown = true;

            info.css({
                top: 0,
                left: 200,
                display: 'block'
            }).animate({
                top: '+=' + distance + 'px',
                opacity: 1
            }, time, 'swing', function() {
                beingShown = false;
                shown = true;
            });
        }

        return false;
    }).mouseout(function () {
        if (hideDelayTimer) clearTimeout(hideDelayTimer);
        hideDelayTimer = setTimeout(function () {
            hideDelayTimer = null;
            info.animate({
                top: '-=' + distance + 'px',
                opacity: 0
            }, time, 'swing', function () {
                shown = false;
                info.css('display', 'none');
            });
        }, hideDelay);
	return false;
    });
});
</script>
<?php }} ?>