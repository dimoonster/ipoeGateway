<?php /* Smarty version Smarty-3.1.7, created on 2012-02-15 16:46:46
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/createForm.html" */ ?>
<?php /*%%SmartyHeaderCode:18639919874f391fb52a6145-93046560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5b264215d1ccf7eb0fe9f0e612d4fb50366295c' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/services/my.tariff/createForm.html',
      1 => 1329309994,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18639919874f391fb52a6145-93046560',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f391fb542ef7',
  'variables' => 
  array (
    'MIN_SPEED' => 0,
    'MAX_SPEED' => 0,
    'index' => 0,
    'SPEED_PER_HOUR' => 0,
    'COST_PER_HOUR' => 0,
    'MINIMAL_COST' => 0,
    'BASE_URL' => 0,
    'SERVICE_URL' => 0,
    'AJAX' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f391fb542ef7')) {function content_4f391fb542ef7($_smarty_tpl) {?><style>
.sliders { margin-top: 38px; border: 0px solid #000; width: 800px;}

.ui-slider { position: relative; text-align: left; margin-left: 10px;}
.ui-slider .ui-slider-handle { position: absolute; z-index: 2; width: 1.2em; height: 1.2em; cursor: default; border: #bbb solid 1px; background:#eeeeee; -moz-box-shadow: 1px 1px 2px #fff inset; -webkit-box-shadow: 1px 1px 2px #fff inset; box-shadow: 1px 1px 2px #fff inset; border-radius:4px 4px 4px 4px; -moz-border-radius:4px 4px 4px 4px; -webkit-border-radius:4px 4px 4px 4px; }

.ui-slider .ui-slider-range { position: absolute; z-index: 1; font-size: .7em; display: block; background:#eeeeee; border:#bbb solid 1px; background-position: 0 0; border-radius:4px 4px 4px 4px; -moz-border-radius:4px 4px 4px 4px; -webkit-border-radius:4px 4px 4px 4px;}

.ui-slider-vertical { padding:0px;width: .8em; height: 100px; border: #bbb dashed 1px; border-radius:4px 4px 4px 4px; -moz-border-radius:4px 4px 4px 4px; -webkit-border-radius:4px 4px 4px 4px;}
.ui-slider-vertical .ui-slider-handle { left: -3px; margin-left: 0; margin-bottom: -.6em; z-index:6; background:#f6f6f6;}
.ui-slider-vertical .ui-state-hover { left: -3px; margin-left: 0; margin-bottom: -.6em; z-index:6; background:#fdf5ce;}
.ui-slider-vertical .ui-slider-range { left: -1px; width: 100%; bottoom: -10px;z-index:5;background-image: -moz-linear-gradient(top, #ccc, #eee); background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, #ccc),color-stop(1, #eee));filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#eeeeee', endColorstr='#cccccc');-ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#eeeeee', endColorstr='#cccccc')" }
.ui-slider-vertical .ui-slider-range-min { bottom: 0; }
.ui-slider-vertical .ui-slider-range-max { top: 0; }

.clr { clear:both; padding:0; margin:0; background:none;}

.chooser { float: left; color:#f6931f; font: bold 12px Arial, Helvetica, sans-serif; width: 2.5em; border: 0px solid #000; height:300px;}
.chooser .time { float:left; margin-top: 8px; position: relative; margin-left: 0px; border: 0px solid #000;width:100%;text-align:center;}
.chooser .price { float:left; margin-top: 18px; position: relative; border: 0px solid #000; text-align:center;}
.chooser .pricetxt { float:left; margin-top: 5px; position: relative; border: 0px solid #000; text-align:center;}

.chooser .speed { float:left; margin-top: -30px; margin-left: 3px;}

.chooser input[type=text] { margin-top:-2px;border:0;width: 25px; color:#f6931f; font-weight:bold;text-align:center; background: none;}
.chooser input[disabled] { margin-top:-2px;border:0;width: 25px; color:#f6931f; font-weight:bold;text-align:center; background: none; } 

.sliders .result { background:#eeeeee;width: 100%; text-align: center; border: 1px dashed #ababab; padding: 5px; border-radius:5px 5px 5px 5px; -moz-border-radius:5px 5px 5px 5px; -webkit-border-radius:5px 5px 5px 5px;}
.sliders .result span { font: bold 12px Arial, Helvetica, sans-serif; }
.sliders .result input { background: none; border: 0; color: #f6931f; font: bold 26px Arial, Helvetica, sans-serif; width: 200px; padding: 5px;}

#createTariff .submit { cursor:pointer; margin-top: 10px; border: 0px; align:center; background:none; width:150px; text-align:center;font: bold 16px Arial, Helvetica, sans-serif;color:#999;}
#createTariff .submit:hover { text-decoration:underline;}
</style>

<!--[if IE]>
<style>
.ui-slider-vertical { padding:0px;width: .8em; height: 100px; border: #bbb dashed 0px; border-radius:4px 4px 4px 4px; }
.chooser { float: left; color:#f6931f; font: bold 12px Tahoma; width: 22px; cursor: default;}
.chooser .speed { float: left;color:#f6931f;position:relative; margin-top: -30px; text-align:center; border: 0px solid #000; margin-left: 1px; }
.chooser .time { float: left; margin-top: 8px; text-align:center; border: 0px solid #000; margin-left: 2px;width:100%;border:0px solid #000000;}
.chooser input { margin-top:-2px;border:0;width: 25px; color:#f6931f; font-weight:bold;text-align:center; background: none;}
.chooser .price { color:#777;width:60px;height:25px;float: left;position: relative; margin-left: 5px; margin-top: 12px; text-align:center;  -sand-transform: rotate(90deg);filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);text-shadow: none;}
</style>
<![endif]-->

<script>
var min_speed = <?php echo $_smarty_tpl->tpl_vars['MIN_SPEED']->value;?>
;
var max_speed = <?php echo $_smarty_tpl->tpl_vars['MAX_SPEED']->value;?>
;

var values = [];
var prices = [];

<?php $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int)ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? 23+1 - (0) : 0-(23)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0){
for ($_smarty_tpl->tpl_vars['index']->value = 0, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++){
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration == 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration == $_smarty_tpl->tpl_vars['index']->total;?>
values[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
] = <?php echo $_smarty_tpl->tpl_vars['SPEED_PER_HOUR']->value[$_smarty_tpl->tpl_vars['index']->value];?>
;
<?php }} ?>

<?php $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int)ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? 23+1 - (0) : 0-(23)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0){
for ($_smarty_tpl->tpl_vars['index']->value = 0, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++){
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration == 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration == $_smarty_tpl->tpl_vars['index']->total;?>
prices[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
] = <?php echo $_smarty_tpl->tpl_vars['COST_PER_HOUR']->value[$_smarty_tpl->tpl_vars['index']->value];?>
;
<?php }} ?>

function calc_price() {
    var t_speed;
    var m_speed;
    var t_price;
    
    m_speed = 0;
    t_price = <?php echo $_smarty_tpl->tpl_vars['MINIMAL_COST']->value;?>
;
    
    for(i=0;i < 24; i++) {		// >
	mobj = "#amount"+i;
	t_speed = $( mobj ).val();
	m_speed += parseInt(t_speed);
	t_price += t_speed * prices[i];
    }
    
    m_speed = m_speed / 24;
    m_speed = Math.round(100*m_speed)/100;
    t_price = Math.round(100*t_price)/100;
    
    $( "#total-price" ).val( t_price + " руб.");
    $( "#ttl-speed" ).val( m_speed + " Мбит/с");
}

$(function() {
    $( "#slider-vertical0" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[0], slide: function( event, ui ) { $( "#amount0" ).val( ui.value ); $( "#samount0" ).val( ui.value ); calc_price();} });$( "#amount0" ).val( $( "#slider-vertical0" ).slider( "value" ) );$( "#samount0" ).val( $( "#slider-vertical0" ).slider( "value" ) );
    $( "#slider-vertical1" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[1], slide: function( event, ui ) { $( "#amount1" ).val( ui.value ); $( "#samount1" ).val( ui.value ); calc_price();} });$( "#amount1" ).val( $( "#slider-vertical1" ).slider( "value" ) );$( "#samount1" ).val( $( "#slider-vertical1" ).slider( "value" ) );
    $( "#slider-vertical2" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[2], slide: function( event, ui ) { $( "#amount2" ).val( ui.value ); $( "#samount2" ).val( ui.value ); calc_price();} });$( "#amount2" ).val( $( "#slider-vertical2" ).slider( "value" ) );$( "#samount2" ).val( $( "#slider-vertical2" ).slider( "value" ) );
    $( "#slider-vertical3" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[3], slide: function( event, ui ) { $( "#amount3" ).val( ui.value ); $( "#samount3" ).val( ui.value ); calc_price();} });$( "#amount3" ).val( $( "#slider-vertical3" ).slider( "value" ) );$( "#samount3" ).val( $( "#slider-vertical3" ).slider( "value" ) );
    $( "#slider-vertical4" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[4], slide: function( event, ui ) { $( "#amount4" ).val( ui.value ); $( "#samount4" ).val( ui.value ); calc_price();} });$( "#amount4" ).val( $( "#slider-vertical4" ).slider( "value" ) );$( "#samount4" ).val( $( "#slider-vertical4" ).slider( "value" ) );
    $( "#slider-vertical5" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[5], slide: function( event, ui ) { $( "#amount5" ).val( ui.value ); $( "#samount5" ).val( ui.value ); calc_price();} });$( "#amount5" ).val( $( "#slider-vertical5" ).slider( "value" ) );$( "#samount5" ).val( $( "#slider-vertical5" ).slider( "value" ) );
    $( "#slider-vertical6" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[6], slide: function( event, ui ) { $( "#amount6" ).val( ui.value ); $( "#samount6" ).val( ui.value ); calc_price();} });$( "#amount6" ).val( $( "#slider-vertical6" ).slider( "value" ) );$( "#samount6" ).val( $( "#slider-vertical6" ).slider( "value" ) );
    $( "#slider-vertical7" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[7], slide: function( event, ui ) { $( "#amount7" ).val( ui.value ); $( "#samount7" ).val( ui.value ); calc_price();} });$( "#amount7" ).val( $( "#slider-vertical7" ).slider( "value" ) );$( "#samount7" ).val( $( "#slider-vertical7" ).slider( "value" ) );
    $( "#slider-vertical8" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[8], slide: function( event, ui ) { $( "#amount8" ).val( ui.value ); $( "#samount8" ).val( ui.value ); calc_price();} });$( "#amount8" ).val( $( "#slider-vertical8" ).slider( "value" ) );$( "#samount8" ).val( $( "#slider-vertical8" ).slider( "value" ) );
    $( "#slider-vertical9" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[9], slide: function( event, ui ) { $( "#amount9" ).val( ui.value ); $( "#samount9" ).val( ui.value ); calc_price();} });$( "#amount9" ).val( $( "#slider-vertical9" ).slider( "value" ) );$( "#samount9" ).val( $( "#slider-vertical9" ).slider( "value" ) );
    $( "#slider-vertical10" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[10], slide: function( event, ui ) { $( "#amount10" ).val( ui.value ); $( "#samount10" ).val( ui.value ); calc_price();} });$( "#amount10" ).val( $( "#slider-vertical10" ).slider( "value" ) );$( "#samount10" ).val( $( "#slider-vertical10" ).slider( "value" ) );
    $( "#slider-vertical11" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[11], slide: function( event, ui ) { $( "#amount11" ).val( ui.value ); $( "#samount11" ).val( ui.value ); calc_price();} });$( "#amount11" ).val( $( "#slider-vertical11" ).slider( "value" ) );$( "#samount11" ).val( $( "#slider-vertical11" ).slider( "value" ) );
    $( "#slider-vertical12" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[12], slide: function( event, ui ) { $( "#amount12" ).val( ui.value ); $( "#samount12" ).val( ui.value ); calc_price();} });$( "#amount12" ).val( $( "#slider-vertical12" ).slider( "value" ) );$( "#samount12" ).val( $( "#slider-vertical12" ).slider( "value" ) );
    $( "#slider-vertical13" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[13], slide: function( event, ui ) { $( "#amount13" ).val( ui.value ); $( "#samount13" ).val( ui.value ); calc_price();} });$( "#amount13" ).val( $( "#slider-vertical13" ).slider( "value" ) );$( "#samount13" ).val( $( "#slider-vertical13" ).slider( "value" ) );
    $( "#slider-vertical14" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[14], slide: function( event, ui ) { $( "#amount14" ).val( ui.value ); $( "#samount14" ).val( ui.value ); calc_price();} });$( "#amount14" ).val( $( "#slider-vertical14" ).slider( "value" ) );$( "#samount14" ).val( $( "#slider-vertical14" ).slider( "value" ) );
    $( "#slider-vertical15" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[15], slide: function( event, ui ) { $( "#amount15" ).val( ui.value ); $( "#samount15" ).val( ui.value ); calc_price();} });$( "#amount15" ).val( $( "#slider-vertical15" ).slider( "value" ) );$( "#samount15" ).val( $( "#slider-vertical15" ).slider( "value" ) );
    $( "#slider-vertical16" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[16], slide: function( event, ui ) { $( "#amount16" ).val( ui.value ); $( "#samount16" ).val( ui.value ); calc_price();} });$( "#amount16" ).val( $( "#slider-vertical16" ).slider( "value" ) );$( "#samount16" ).val( $( "#slider-vertical16" ).slider( "value" ) );
    $( "#slider-vertical17" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[17], slide: function( event, ui ) { $( "#amount17" ).val( ui.value ); $( "#samount17" ).val( ui.value ); calc_price();} });$( "#amount17" ).val( $( "#slider-vertical17" ).slider( "value" ) );$( "#samount17" ).val( $( "#slider-vertical17" ).slider( "value" ) );
    $( "#slider-vertical18" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[18], slide: function( event, ui ) { $( "#amount18" ).val( ui.value ); $( "#samount18" ).val( ui.value ); calc_price();} });$( "#amount18" ).val( $( "#slider-vertical18" ).slider( "value" ) );$( "#samount18" ).val( $( "#slider-vertical18" ).slider( "value" ) );
    $( "#slider-vertical19" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[19], slide: function( event, ui ) { $( "#amount19" ).val( ui.value ); $( "#samount19" ).val( ui.value ); calc_price();} });$( "#amount19" ).val( $( "#slider-vertical19" ).slider( "value" ) );$( "#samount19" ).val( $( "#slider-vertical19" ).slider( "value" ) );
    $( "#slider-vertical20" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[20], slide: function( event, ui ) { $( "#amount20" ).val( ui.value ); $( "#samount20" ).val( ui.value ); calc_price();} });$( "#amount20" ).val( $( "#slider-vertical20" ).slider( "value" ) );$( "#samount20" ).val( $( "#slider-vertical20" ).slider( "value" ) );
    $( "#slider-vertical21" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[21], slide: function( event, ui ) { $( "#amount21" ).val( ui.value ); $( "#samount21" ).val( ui.value ); calc_price();} });$( "#amount21" ).val( $( "#slider-vertical21" ).slider( "value" ) );$( "#samount21" ).val( $( "#slider-vertical21" ).slider( "value" ) );
    $( "#slider-vertical22" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[22], slide: function( event, ui ) { $( "#amount22" ).val( ui.value ); $( "#samount22" ).val( ui.value ); calc_price();} });$( "#amount22" ).val( $( "#slider-vertical22" ).slider( "value" ) );$( "#samount22" ).val( $( "#slider-vertical22" ).slider( "value" ) );
    $( "#slider-vertical23" ).slider({ orientation: "vertical", range: "min", min: min_speed, max: max_speed, value: values[23], slide: function( event, ui ) { $( "#amount23" ).val( ui.value ); $( "#samount23" ).val( ui.value ); calc_price();} });$( "#amount23" ).val( $( "#slider-vertical23" ).slider( "value" ) );$( "#samount23" ).val( $( "#slider-vertical23" ).slider( "value" ) );


    for(i=23;i>=0;i--) { $( "#price"+i ).html(prices[i]+" руб.") };

    calc_price();
});

</script>

<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['SERVICE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['AJAX']->value;?>
&createForm&page1" id="createTariff" name="createTariff">

<div class="sliders">
<p style="display:none;">
    <input type="text" name="samount0" id="samount0" />
    <input type="text" name="samount1" id="samount1" />
    <input type="text" name="samount2" id="samount2" />
    <input type="text" name="samount3" id="samount3" />
    <input type="text" name="samount4" id="samount4" />
    <input type="text" name="samount5" id="samount5" />
    <input type="text" name="samount6" id="samount6" />
    <input type="text" name="samount7" id="samount7" />
    <input type="text" name="samount8" id="samount8" />
    <input type="text" name="samount9" id="samount9" />
    <input type="text" name="samount10" id="samount10" />
    <input type="text" name="samount11" id="samount11" />
    <input type="text" name="samount12" id="samount12" />
    <input type="text" name="samount13" id="samount13" />
    <input type="text" name="samount14" id="samount14" />
    <input type="text" name="samount15" id="samount15" />
    <input type="text" name="samount16" id="samount16" />
    <input type="text" name="samount17" id="samount17" />
    <input type="text" name="samount18" id="samount18" />
    <input type="text" name="samount19" id="samount19" />
    <input type="text" name="samount20" id="samount20" />
    <input type="text" name="samount21" id="samount21" />
    <input type="text" name="samount22" id="samount22" />
    <input type="text" name="samount23" id="samount23" />
</p>

<div class="chooser" style="width:70px;"><div class="speed" id="slider-speed0">Скорость</div><div id="slider-vertical" style="height:200px; float: left;">&nbsp;</div><div class="time">Время <small>(часы)</small></div><div class="pricetxt">Цена за Мбит/с<br /><small>(в месяц)</small></div></div>
<div class="chooser"><div class="speed" id="slider-speed0"><input type="text" id="amount0" disabled /></div><div id="slider-vertical0" style="height:200px; float: left;"></div><div class="time">00</div><div class="price"><div id="price0"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed1"><input type="text" id="amount1" disabled /></div><div id="slider-vertical1" style="height:200px; float: left;"></div><div class="time">01</div><div class="price"><div id="price1"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed2"><input type="text" id="amount2" disabled /></div><div id="slider-vertical2" style="height:200px; float: left;"></div><div class="time">02</div><div class="price"><div id="price2"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed3"><input type="text" id="amount3" disabled /></div><div id="slider-vertical3" style="height:200px; float: left;"></div><div class="time">03</div><div class="price"><div id="price3"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed4"><input type="text" id="amount4" disabled /></div><div id="slider-vertical4" style="height:200px; float: left;"></div><div class="time">04</div><div class="price"><div id="price4"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed5"><input type="text" id="amount5" disabled /></div><div id="slider-vertical5" style="height:200px; float: left;"></div><div class="time">05</div><div class="price"><div id="price5"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed6"><input type="text" id="amount6" disabled /></div><div id="slider-vertical6" style="height:200px; float: left;"></div><div class="time">06</div><div class="price"><div id="price6"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed7"><input type="text" id="amount7" disabled /></div><div id="slider-vertical7" style="height:200px; float: left;"></div><div class="time">07</div><div class="price"><div id="price7"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed8"><input type="text" id="amount8" disabled /></div><div id="slider-vertical8" style="height:200px; float: left;"></div><div class="time">08</div><div class="price"><div id="price8"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed9"><input type="text" id="amount9" disabled /></div><div id="slider-vertical9" style="height:200px; float: left;"></div><div class="time">09</div><div class="price"><div id="price9"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed10"><input type="text" id="amount10" disabled /></div><div id="slider-vertical10" style="height:200px; float: left;"></div><div class="time">10</div><div class="price"><div id="price10"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed11"><input type="text" id="amount11" disabled /></div><div id="slider-vertical11" style="height:200px; float: left;"></div><div class="time">11</div><div class="price"><div id="price11"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed12"><input type="text" id="amount12" disabled /></div><div id="slider-vertical12" style="height:200px; float: left;"></div><div class="time">12</div><div class="price"><div id="price12"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed13"><input type="text" id="amount13" disabled /></div><div id="slider-vertical13" style="height:200px; float: left;"></div><div class="time">13</div><div class="price"><div id="price13"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed14"><input type="text" id="amount14" disabled /></div><div id="slider-vertical14" style="height:200px; float: left;"></div><div class="time">14</div><div class="price"><div id="price14"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed15"><input type="text" id="amount15" disabled /></div><div id="slider-vertical15" style="height:200px; float: left;"></div><div class="time">15</div><div class="price"><div id="price15"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed16"><input type="text" id="amount16" disabled /></div><div id="slider-vertical16" style="height:200px; float: left;"></div><div class="time">16</div><div class="price"><div id="price16"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed17"><input type="text" id="amount17" disabled /></div><div id="slider-vertical17" style="height:200px; float: left;"></div><div class="time">17</div><div class="price"><div id="price17"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed18"><input type="text" id="amount18" disabled /></div><div id="slider-vertical18" style="height:200px; float: left;"></div><div class="time">18</div><div class="price"><div id="price18"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed19"><input type="text" id="amount19" disabled /></div><div id="slider-vertical19" style="height:200px; float: left;"></div><div class="time">19</div><div class="price"><div id="price19"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed20"><input type="text" id="amount20" disabled /></div><div id="slider-vertical20" style="height:200px; float: left;"></div><div class="time">20</div><div class="price"><div id="price20"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed21"><input type="text" id="amount21" disabled /></div><div id="slider-vertical21" style="height:200px; float: left;"></div><div class="time">21</div><div class="price"><div id="price21"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed22"><input type="text" id="amount22" disabled /></div><div id="slider-vertical22" style="height:200px; float: left;"></div><div class="time">22</div><div class="price"><div id="price22"></div></div></div>
<div class="chooser"><div class="speed" id="slider-speed23"><input type="text" id="amount23" disabled /></div><div id="slider-vertical23" style="height:200px; float: left;"></div><div class="time">23</div><div class="price"><div id="price23"></div></div></div>

<div class="clr"></div>
<div class="result">
    <span>Итоговая цена в месяц:</span> <input type="text" id="total-price" disabled value="0" />
    <span>Среднесуточная скорость доступа:</span> <input type="text" id="ttl-speed" disabled value="0" />
</div>

<div style="text-align:center">
<input class="submit" type="submit" value="Создать тариф" />
</div>
</div> <!-- sliders -->

</form>


<div class="clr"></div>

<script>
$('#createTariff').ajaxForm({ target: '#ajaxContent' });
</script><?php }} ?>