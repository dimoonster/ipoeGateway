<?php /* Smarty version Smarty-3.1.7, created on 2012-02-13 18:35:31
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/select.css" */ ?>
<?php /*%%SmartyHeaderCode:19235437644f391fb38ebcb4-09481770%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5785dfd40ac5b6b80185f2baceae6a04c7261cd3' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/select.css',
      1 => 1328185798,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19235437644f391fb38ebcb4-09481770',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f391fb3983fc',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f391fb3983fc')) {function content_4f391fb3983fc($_smarty_tpl) {?>.sel_wrap{
    margin-bottom:5px;
    padding:7px;
}
.sel_wrap select{
    display:none;
}
.sel_imul{
    width:300px;
}
.sel_imul .sel_selected{
    background:#fff;
    border:1px solid #bbb;
    padding:3px 6px;
    font-size:14px;
    font-family:Times;
    cursor:pointer;
    position:relative;
}
.sel_imul.act .sel_selected{
    background:#efefef;
}
.sel_selected .sel_arraw{
    height:100%;
    width:20px;
    background:url('<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/arraw1.png') 50% 50% no-repeat;
    position:absolute;
    top:0px;
    right:0px;    
}
.sel_imul:hover .sel_selected .sel_arraw{
    background-color:#e0e0e0;
    border-left:1px solid #bbb;
}
.sel_imul.act .sel_selected .sel_arraw{
    background-color:#e0e0e0;
    border-left:1px solid #bbb;
}
.sel_imul .sel_options{
    background:#fff;
    border:1px solid #dbdbdb;
    border-top:none;
    overflow:auto;
    position:absolute;
    width:298px;
    display:none;
    z-index:10;
}
.sel_options .sel_option{
    padding:3px 4px;
    font-size:14px;
    font-family:Times;
    border:1px solid #fff;
    border-right:none;
    border-left:none;
}
.sel_options .sel_option:hover{
    border-color:#dbdbdb;
    cursor:pointer;
}
.sel_options .sel_option.sel_ed{
    background:#dbdbdb;
    border-color:#dbdbdb;
}

/*second variant*/
.sec .sel_imul{
    width:200px;
}
.sec .sel_imul .sel_selected{
    border:1px solid #C0CAD5;
}
.sel_imul.act .sel_selected{
    background:#fff;
}
.sec .sel_imul:hover .sel_selected .sel_arraw{
    background-color:#e1e8ed;
    border-left:1px solid #d2dbe0;
}
.sec .sel_imul.act .sel_selected .sel_arraw{
    background-color:#e1e8ed;
    border-left:1px solid #d2dbe0;
}
.sec .sel_imul .sel_options{
    background:#fff;
    border:1px solid #d2dbe0;
    width:198px;
}
.sec.overf .sel_imul .sel_options{
    height:100px;
}
.sec .sel_options .sel_option:hover, .sec .sel_options .sel_option.sel_ed{
    background:#587da1;
    border:1px solid #2a5883;
    color:#fff;
    cursor:pointer;
}
.sec .sel_imul .sel_selected .sel_arraw{
    background-image:url('<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/darr_dd_out.gif');
}

.sec.round .sel_imul .sel_selected{
    -webkit-border-radius:5px;
    -moz-border-radius:5px;
    border-radius:5px;
}
.sec.round .sel_imul .sel_selected .sel_arraw{
    -webkit-border-radius:0 5px 5px 0;
    -moz-border-radius:0 5px 5px 0;
    border-radius:0 5px 5px 0;
}
.sec.round .sel_imul .sel_options{
    -webkit-border-radius:0 0 5px 5px;
    -moz-border-radius:0 0 5px 5px;
    border-radius:0 0 5px 5px;
}
/*green*/
.sec.green .sel_imul .sel_selected{
    border-color:#FFAD99;
}
.sec.green .sel_imul:hover .sel_selected .sel_arraw,
.sec.green .sel_imul.act .sel_selected .sel_arraw{
    background-color:#FFD6CC;
    border-left:1px solid #FFAD99;
}
.sec.green .sel_options .sel_option:hover, 
.sec.green .sel_options .sel_option.sel_ed{
    background:#FF9980;
    border:1px solid #FF704D;
    color:#fff;
    cursor:pointer;
}
<?php }} ?>