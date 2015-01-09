<?php /* Smarty version Smarty-3.1.14, created on 2015-01-09 10:52:58
         compiled from "templates\controls\listview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2784154afa4a5886386-77964771%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0f5a02b84ca3d348de0ecc27bcc4cec03a97ef3' => 
    array (
      0 => 'templates\\controls\\listview.tpl',
      1 => 1420797173,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2784154afa4a5886386-77964771',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54afa4a5899c16_97655774',
  'variables' => 
  array (
    'list' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54afa4a5899c16_97655774')) {function content_54afa4a5899c16_97655774($_smarty_tpl) {?><div class="listView">

    <div class="toolbar top">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>

    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?> 



        <div class="panel panel-default">
            <div class="panel-heading"><?php echo $_smarty_tpl->tpl_vars['value']->value->title;?>
</div>
            <div class="panel-body">
                <?php echo $_smarty_tpl->tpl_vars['value']->value->description;?>

            </div>
        </div>

        <div class="entry">

            <div class="title"><?php echo $_smarty_tpl->tpl_vars['value']->value->title;?>
</div>
            <div class="subtitle"><?php echo $_smarty_tpl->tpl_vars['value']->value->subtitle;?>
</div>
            <div class="additional">
                <?php echo $_smarty_tpl->tpl_vars['value']->value->additional;?>

            </div>

            <div class="description">

                <?php echo $_smarty_tpl->tpl_vars['value']->value->description;?>

            </div>


        </div>

    <?php } ?>

    <div class="toolbar bottom">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>

</div><?php }} ?>