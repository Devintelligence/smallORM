<?php /* Smarty version Smarty-3.1.14, created on 2015-01-09 11:05:07
         compiled from ".\layouts\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2387754a26853343cc7-51226640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8cdacfa963ae63d71a48f38a9c86f108b24b6854' => 
    array (
      0 => '.\\layouts\\layout.tpl',
      1 => 1420797904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2387754a26853343cc7-51226640',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54a268533630c1_07929646',
  'variables' => 
  array (
    'BASEPATH' => 0,
    'style' => 0,
    'navigation' => 0,
    'value' => 0,
    'children_count' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a268533630c1_07929646')) {function content_54a268533630c1_07929646($_smarty_tpl) {?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gesucht</title>
        <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASEPATH']->value;?>
public/css/reset.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASEPATH']->value;?>
public/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASEPATH']->value;?>
public/css/justified-nav.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
" />

        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASEPATH']->value;?>
public/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASEPATH']->value;?>
public/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="page">


            <nav class="nav">
                <img src="public/img/logo.png" id="logo"/>
                <nav>
                    <ul class="nav nav-justified">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">About gesucht.center</a></li>
                        <li><a href="#">Kontakt</a></li>
                    </ul>
                </nav>
            </nav>


            <div class="content">
                <div class="search">

                    <div class="row">

                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="..." name="query" placeholder="Ihr Suchebegriff">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Alle Kategorien <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navigation']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?> 

                                            <li rel='<?php echo $_smarty_tpl->tpl_vars['value']->value["parent"]->getCategorieId();?>
'><?php echo $_smarty_tpl->tpl_vars['value']->value["parent"]->getName();?>

                                                <?php $_smarty_tpl->tpl_vars['children_count'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['value']->value["children"]), null, 0);?> 

                                                <?php if ($_smarty_tpl->tpl_vars['children_count']->value>0){?>
                                                    <ul>
                                                        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['value']->value["children"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> 
                                                            <li rel='<?php echo $_smarty_tpl->tpl_vars['v']->value->getCategorieId();?>
'><?php echo $_smarty_tpl->tpl_vars['v']->value->getName();?>
</li>
                                                            <?php } ?>

                                                    </ul>
                                                <?php }?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div><!-- /btn-group -->
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->

                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="..." name="query" placeholder="Ort, Plz">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Im Ort <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                        <li rel="5"> + 5 km</li>
                                        <li rel="10"> + 10 km</li>
                                        <li rel="25"> + 25 km</li>
                                        <li rel="50"> + 50 km</li>
                                        <li rel="100"> + 100 km</li>

                                    </ul>
                                </div><!-- /btn-group -->
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->

                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div><!-- /.row -->

                </div>



                ###content###
            </div>

            <footer class="footer">
                <div class="container">
                    <p class="text-muted">Place sticky footer content here.</p>
                </div>
            </footer>

        </div>

    </body>

</html><?php }} ?>