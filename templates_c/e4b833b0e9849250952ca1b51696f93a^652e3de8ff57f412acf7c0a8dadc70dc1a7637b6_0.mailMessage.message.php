<?php
/* Smarty version 3.1.36, created on 2020-11-19 05:50:58
  from 'mailMessage:message' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb607c250cf28_97577048',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '652e3de8ff57f412acf7c0a8dadc70dc1a7637b6' => 
    array (
      0 => 'mailMessage:message',
      1 => 1605765058,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb607c250cf28_97577048 (Smarty_Internal_Template $_smarty_tpl) {
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
<!-- message header end --><p align="center">
<strong>PLEASE PRINT THIS MESSAGE FOR YOUR RECORDS - PLEASE READ THIS EMAIL IN FULL.</strong>
</p>
<p>
If you have requested a domain name during sign up then this will not be visible on the internet for between 24 and 72 hours. This process is called Propagation. Until your domain has Propagated your website and email will not function, we have provided a temporary url which you may use to view your website and upload files in the meantime.
</p>
<p>
Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,
</p>
<p>
The reseller hosting account for <?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
 has been set up. The username and password below are for both cPanel to manage the website at <?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
 and WebHostManager to manage your Reseller Account.
</p>
<p>
<strong>New Account Info</strong>
</p>
<p>
Domain: <?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
<br />
Username: <?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>
<br />
Password: <?php echo $_smarty_tpl->tpl_vars['service_password']->value;?>
<br />
Hosting Package: <?php echo $_smarty_tpl->tpl_vars['service_product_name']->value;?>

</p>
<p>
Control Panel: <a href="http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2082/">http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2082/</a><br />
Web Host Manager: <a href="http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2086/">http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2086/</a>
</p>
<p>
-------------------------------------------------------------------------------------------- <br />
<strong>Web Host Manager Quick Start</strong> <br />
-------------------------------------------------------------------------------------------- <br />
<br />
To access your Web Host Manager, use the following address:<br />
<br />
<a href="http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2086/">http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2086/</a><br />
<br />
The <strong>http://</strong> must be in the address line to connect to port :2086 <br />
Please use the username/password given above. <br />
<br />
<strong><em>To Create a New Account <br />
</em></strong><br />
The first thing you need to do is scroll down on the left and click on &#39Add Package&#39 so that you can create your own hosting packages. You cannot install a domain onto your account without first creating packages.<br />
<br />
1. Click on &#39Create a New Account&#39 from the left hand side menu <br />
2. Put the domain in the &#39Domain&#39 box (no www or http or spaces ? just domainname.com). After putting in the domain, hit TAB and it will automatically create a username. Also, enter a password for the account.<br />
3. Your package selection should be one that you created earlier <br />
4. Then press the create button <br />
<br />
This will give you a confirmation page (you should print this for your records)
</p>
<p>
Please do not click on anything that you are not sure what it does. Please do not try to alter the WHM Theme from the selection box - fatal errors may occur. 
</p>
<p>
-------------------------------------------------------------------------------------------- 
</p>
<p>
Temporarily you may use one of the addresses given below manage your web site
</p>
<p>
Temporary FTP Hostname: <?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
<br />
Temporary Webpage URL: <a href="http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
/~<?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>
/">http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
/~<?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>
/</a><br />
Temporary Control Panel: <a href="http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
/cpanel">http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
/cpanel</a>
</p>
<p>
Once your domain has Propagated
</p>
<p>
FTP Hostname: www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
<br />
Webpage URL: <a href="http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
">http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
</a><br />
Control Panel: <a href="http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
/cpanel">http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
/cpanel</a><br />
Web Host Manager: <a href="http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
/whm">http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
/whm</a>
</p>
<p>
<strong>Mail settings</strong>
</p>
<p>
Catch all email with your default email account
</p>
<p>
POP3 Host Address : mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
<br />
SMTP Host Address: mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
<br />
Username: <?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>
<br />
Password: <?php echo $_smarty_tpl->tpl_vars['service_password']->value;?>

</p>
<p>
Additional mail accounts that you add
</p>
<p>
POP3 Host Address : mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
<br />
SMTP Host Address: mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
<br />
Username : The FULL email address that you are picking up from (e.g. info@yourdomain.com). <br />
If your email client cannot accept a @ symbol, then you may replace this with a backslash .<br />
Password : As specified in your control panel 
</p>
<p>
Thank you for choosing us.
</p>
<p>
<?php echo $_smarty_tpl->tpl_vars['signature']->value;?>

</p>
<!-- message footer start -->
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
