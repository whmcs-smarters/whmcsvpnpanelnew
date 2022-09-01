<?php
/* Smarty version 3.1.36, created on 2020-11-21 06:09:43
  from 'mailMessage:message' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb8af27722363_39349664',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '652e3de8ff57f412acf7c0a8dadc70dc1a7637b6' => 
    array (
      0 => 'mailMessage:message',
      1 => 1605938983,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb8af27722363_39349664 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['charset']->value;?>
" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <style type="text/css">
            [EmailCSS]
        </style>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                <tr>
                    <td align="center" valign="top" id="bodyCell">
                        <table border="0" cellpadding="0" cellspacing="0" id="templateContainer">
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">
                                        <tr>
                                            <td valign="top" class="headerContent">
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['company_domain']->value;?>
">
                                                    <img src="<?php echo $_smarty_tpl->tpl_vars['company_logo_url']->value;?>
" style="max-width:600px;padding:20px 20px 0 20px" id="headerImage" alt="<?php echo $_smarty_tpl->tpl_vars['company_name']->value;?>
" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                                        <tr>
                                            <td valign="top" class="bodyContent">
<!-- message header end --><p><span style="font-size: small;">Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,</span><br /><span style="font-size: small;"><br />Thanks for buying our service. Your service <?php echo $_smarty_tpl->tpl_vars['service_product_name']->value;?>
 has now activated.</span><br /><span style="font-size: small;">Please use the following to details to use your service. </span><br /><br /><span style="font-size: small;"><strong>Your VPNService Details are:</strong> <br /></span><br /><span style="font-size: small;"><strong>Your Username :</strong> <?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>
</span><br /><br /><span style="font-size: small;"><strong>Your Password :</strong> <?php echo $_smarty_tpl->tpl_vars['service_password']->value;?>
<br /><br /><br /><span style="font-size: small;"><strong>Your VPNService App login Details are:</strong> <br /></span><br /><span style="font-size: small;"><strong>Your Username :</strong> <?php echo $_smarty_tpl->tpl_vars['client_email']->value;?>
</span><br /><br /><span style="font-size: small;"><strong>Your Password :</strong> <?php echo $_smarty_tpl->tpl_vars['client_password']->value;?>
 (Your panel login password)</span><br /></span><span style="font-size: small;"><span style="font-size: small;"><br /><span style="font-size: small;"><span style="font-size: small;"><strong>Your VPNService App Download Links:</strong></span></span><br /><br /></span></span>Android App Link:  <?php echo $_smarty_tpl->tpl_vars['androidapplinks']->value;?>
<br />Window App Link:  <?php echo $_smarty_tpl->tpl_vars['windowapplinks']->value;?>
<br />Ios App Link:  <?php echo $_smarty_tpl->tpl_vars['iosapplinks']->value;?>
<br />Linux App Link:  <?php echo $_smarty_tpl->tpl_vars['linuxapplinks']->value;?>
</p><hr /><p><span style="font-size: small;"><strong>Billing Info: </strong></span></p><p><span style="font-size: small;">Product/Service: <?php echo $_smarty_tpl->tpl_vars['service_product_name']->value;?>
</span><br /><span style="font-size: small;">Payment Method: <?php echo $_smarty_tpl->tpl_vars['service_payment_method']->value;?>
</span><br /><span>Amount: <?php echo $_smarty_tpl->tpl_vars['service_recurring_amount']->value;?>
</span><br /><span style="font-size: small;">Billing Cycle: <?php echo $_smarty_tpl->tpl_vars['service_billing_cycle']->value;?>
</span><br /><span style="font-size: small;">Next Due Date: <?php echo $_smarty_tpl->tpl_vars['service_next_due_date']->value;?>
</span></p><p><span style="font-size: small;">Thank you for choosing us.</span></p><p><span style="font-size: small;"><?php echo $_smarty_tpl->tpl_vars['signature']->value;?>
</span></p><!-- message footer start -->
</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                                        <tr>
                                            <td valign="top" class="footerContent">
                                                 <a href="<?php echo $_smarty_tpl->tpl_vars['company_domain']->value;?>
">visit our website</a>
                                                <span class="hide-mobile"> | </span>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['whmcs_url']->value;?>
">log in to your account</a>
                                                <span class="hide-mobile"> | </span>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['whmcs_url']->value;?>
submitticket.php">get support</a> <br />
                                                Copyright © <?php echo $_smarty_tpl->tpl_vars['company_name']->value;?>
, All rights reserved.
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html><?php }
}
