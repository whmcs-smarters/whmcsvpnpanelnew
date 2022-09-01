<?php
/* Smarty version 3.1.36, created on 2020-11-11 13:30:46
  from '/var/www/html/modules/addons/vpnpanel/templates/vpnuserServices.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fabe786c35500_86586129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4759443a704e5db560498bf3d5784f360232215d' => 
    array (
      0 => '/var/www/html/modules/addons/vpnpanel/templates/vpnuserServices.tpl',
      1 => 1605080588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fabe786c35500_86586129 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    $(document).ready(function() 
    {
        
        $('#displayallclients').DataTable({
            iDisplayLength: 25
        });
        
        
        
        $('.viewPass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.hidePass1').hide();
            
            $(this).parent('td').children('p.viewPass1').show();
            $(this).parent('td').children('button.hidePass').show();
            
        });
        
        $('.hidePass').click(function(){
            $(this).hide();
            $(this).parent('td').children('p.viewPass1').hide();
            
            $(this).parent('td').children('p.hidePass1').show();
            $(this).parent('td').children('button.viewPass').show();
            
        });
        
        $('.showService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').show();
            $(this).parent('td').children('.showService').hide();
            $('.'+cls+'').show(0);
        });
        
         $('.hideService').click(function(){
            var cls = $(this).attr('id');
            $(this).parent('td').children('.hideService').hide();
            $(this).parent('td').children('.showService').show();
            $('.'+cls+'').hide(0);
        });
       
        
        
    });
<?php echo '</script'; ?>
>


<!--breadcrumb-->

<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value;?>

            </ol>
        </nav>
    </div>
            
    <div class="col-md-12"><h2>VPN Service List</h2>
    <h5>Here , You can see the list of VPN Services</h5></div>
</div>
            
<!-- Message -->

<div class="message" style="float: left; width: 100%;">
    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

</div>

<!---clinet list--->
    
<table class="table datatable" id="displayallclients" style="margin-top:20px;border-spacing: 0px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product/Service</th>
            <th>Username</th>
            <th>Password</th>
            <th>Amount</th>
            <th>Billing Cycle</th>
            <!--<th>Signup Date</th>-->
            <th>Next Due Date</th>
            <th>Status</th>
           <?php if ($_smarty_tpl->tpl_vars['disablelogs']->value == 'on') {
} else { ?><th>Actions</th><?php }?>
        </tr>
    </thead>
    <tbody>
        
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientServices']->value, 'clientService');
$_smarty_tpl->tpl_vars['clientService']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['clientService']->value) {
$_smarty_tpl->tpl_vars['clientService']->do_else = false;
?>
            <tr>
                <td>
                    <a href="clientsservices.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientService']->value->userid;?>
&id=<?php echo $_smarty_tpl->tpl_vars['clientService']->value->serviceid;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['clientService']->value->serviceid;?>
</a>
                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['clientService']->value->name;?>

                </td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['clientService']->value->username;?>

                </td>
                <td>
                    <p class="hidePass1 pull-left" style="margin: 5px;">**********</p>
                    <p class="viewPass1 pull-left" style="display: none; margin: 5px;"><?php echo $_smarty_tpl->tpl_vars['clientService']->value->password;?>
</p>
                    <button class="viewPass pull-left btn btn-info" style="display:block;"><i class="fa fa-eye"></i></button>
                    <button class="hidePass pull-left btn btn-info" style="display: none;"><i class="fa fa-eye-slash"></i></button>
                    
                </td>
                <td><?php echo $_smarty_tpl->tpl_vars['clientService']->value->amount;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['clientService']->value->billingcycle;?>
</td>
                <!--<td><?php echo $_smarty_tpl->tpl_vars['clientService']->value->regdate;?>
</td>-->
                <td><?php echo $_smarty_tpl->tpl_vars['clientService']->value->nextduedate;?>
</td>
                <td>
                   <span class="label <?php echo mb_strtolower($_smarty_tpl->tpl_vars['clientService']->value->domainstatus, 'UTF-8');?>
"><?php echo $_smarty_tpl->tpl_vars['clientService']->value->domainstatus;?>
</span>
                </td>
                
                <?php if ($_smarty_tpl->tpl_vars['disablelogs']->value == 'on') {?>
                <?php } else { ?>
                <td>
                    <a class="btn btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
&action=vpn_usage&id=<?php echo $_smarty_tpl->tpl_vars['clientService']->value->serviceid;?>
&m=d">View Usage
                        
                    </a>
                                    </td>
                <?php }?>
            </tr>
            
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<div class="row">
    <a href="<?php echo $_smarty_tpl->tpl_vars['modulelink']->value;?>
" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
</div><?php }
}
