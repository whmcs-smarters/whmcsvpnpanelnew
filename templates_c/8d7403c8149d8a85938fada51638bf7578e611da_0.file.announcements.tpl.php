<?php
/* Smarty version 3.1.36, created on 2020-11-11 11:35:54
  from '/var/www/html/templates/six/announcements.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fabcc9a67fc67_34956372',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d7403c8149d8a85938fada51638bf7578e611da' => 
    array (
      0 => '/var/www/html/templates/six/announcements.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fabcc9a67fc67_34956372 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['announcementsFbRecommend']->value) {?>
    <?php echo '<script'; ?>
>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/<?php echo $_smarty_tpl->tpl_vars['LANG']->value['locale'];?>
/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    <?php echo '</script'; ?>
>
<?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['announcements']->value, 'announcement');
$_smarty_tpl->tpl_vars['announcement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->do_else = false;
?>

    <div class="announcement-single">

        <a href="<?php echo routePath('announcement-view',$_smarty_tpl->tpl_vars['announcement']->value['id'],$_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle']);?>
" class="title">
            <?php echo $_smarty_tpl->tpl_vars['announcement']->value['title'];?>

        </a>

        <?php if (strlen(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['announcement']->value['text'])) < 350) {?>
            <p><?php echo $_smarty_tpl->tpl_vars['announcement']->value['text'];?>
</p>
        <?php } else { ?>
            <p><?php echo $_smarty_tpl->tpl_vars['announcement']->value['summary'];?>

            <a href="<?php echo routePath('announcement-view',$_smarty_tpl->tpl_vars['announcement']->value['id'],$_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle']);?>
" class="label label-warning"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['readmore'];?>
 &raquo;</a>
            </p>
        <?php }?>

        <div class="article-items">
            <i class="fas fa-calendar-alt fa-fw"></i>
            <?php echo $_smarty_tpl->tpl_vars['carbon']->value->createFromTimestamp($_smarty_tpl->tpl_vars['announcement']->value['timestamp'])->format('jS M Y');?>

            <?php if ($_smarty_tpl->tpl_vars['announcement']->value['editLink']) {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['announcement']->value['editLink'];?>
" class="admin-inline-edit">
                    <i class="fas fa-pencil-alt fa-fw"></i>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['edit'];?>

                </a>
            <?php }?>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['announcementsFbRecommend']->value) {?>
            <div class="fb-like hidden-sm hidden-xs" data-layout="standard" data-href="<?php echo fqdnRoutePath('announcement-view',$_smarty_tpl->tpl_vars['announcement']->value['id'],$_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle']);?>
" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
            <div class="fb-like hidden-lg hidden-md" data-layout="button_count" data-href="<?php echo fqdnRoutePath('announcement-view',$_smarty_tpl->tpl_vars['announcement']->value['id'],$_smarty_tpl->tpl_vars['announcement']->value['urlfriendlytitle']);?>
" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
        <?php }?>

    </div>

<?php
}
if ($_smarty_tpl->tpl_vars['announcement']->do_else) {
?>

    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>((string)$_smarty_tpl->tpl_vars['LANG']->value['noannouncements']),'textcenter'=>true), 0, true);
?>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<?php if ($_smarty_tpl->tpl_vars['prevpage']->value || $_smarty_tpl->tpl_vars['nextpage']->value) {?>

    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
        <form class="form-inline" role="form">
            <div class="form-group">
                <div class="input-group">
                    <?php if ($_smarty_tpl->tpl_vars['prevpage']->value) {?>
                        <span class="input-group-btn">
                            <a href="<?php echo routePath('announcement-index-paged',$_smarty_tpl->tpl_vars['prevpage']->value,$_smarty_tpl->tpl_vars['view']->value);?>
" class="btn btn-default">&laquo; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['previouspage'];?>
</a>
                        </span>
                    <?php }?>
                    <input class="form-control" style="text-align: center;" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['page'];?>
 <?php echo $_smarty_tpl->tpl_vars['pagenumber']->value;?>
" disabled="disabled">
                    <?php if ($_smarty_tpl->tpl_vars['nextpage']->value) {?>
                        <span class="input-group-btn">
                            <a href="<?php echo routePath('announcement-index-paged',$_smarty_tpl->tpl_vars['nextpage']->value,$_smarty_tpl->tpl_vars['view']->value);?>
" class="btn btn-default"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['nextpage'];?>
 &raquo;</a>
                        </span>
                    <?php }?>
                </div>
            </div>
        </form>
    </div>
<?php }
}
}
