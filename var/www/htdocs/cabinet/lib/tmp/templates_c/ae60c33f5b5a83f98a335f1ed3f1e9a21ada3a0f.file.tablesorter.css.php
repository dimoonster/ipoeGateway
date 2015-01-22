<?php /* Smarty version Smarty-3.1.7, created on 2012-02-13 18:35:31
         compiled from "/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/tablesorter.css" */ ?>
<?php /*%%SmartyHeaderCode:20869883794f391fb3a74f31-16483773%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae60c33f5b5a83f98a335f1ed3f1e9a21ada3a0f' => 
    array (
      0 => '/opt/ipoev2/var/www/htdocs/cabinet/lib/../template/tablesorter.css',
      1 => 1328787811,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20869883794f391fb3a74f31-16483773',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f391fb3ad967',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f391fb3ad967')) {function content_4f391fb3ad967($_smarty_tpl) {?>/* tables */
table.tablesorter {
	font-family:arial;
	background-color: #CDCDCD;
	margin:10px 0pt 15px;
	font-size: 8pt;
	width: 100%;
	text-align: left;
}
table.tablesorter thead tr th, table.tablesorter tfoot tr th {
	background-color: #e6EEEE;
	border: 1px solid #FFF;
	font-size: 8pt;
	padding: 4px;
}
table.tablesorter thead tr .header {
	background-image: url(bg.gif);
	background-repeat: no-repeat;
	background-position: center right;
	cursor: pointer;
}
table.tablesorter tbody td {
	color: #3D3D3D;
	padding: 4px;
	background-color: #FFF;
	vertical-align: top;
}
table.tablesorter tbody tr.odd td {
	background-color:#F0F0F6;
}
table.tablesorter thead tr .headerSortUp {
	background-image: url(<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/asc.gif);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/tablesorter/desc.gif);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
background-color: #8dbdd8;
}
<?php }} ?>