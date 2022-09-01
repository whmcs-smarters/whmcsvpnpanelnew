<?php
/* Smarty version 3.1.36, created on 2020-11-19 05:50:58
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb607c2512bb7_05959957',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1605765058,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb607c2512bb7_05959957 (Smarty_Internal_Template $_smarty_tpl) {
?>PLEASE PRINT THIS MESSAGE FOR YOUR RECORDS - PLEASE READ THIS EMAIL IN FULL.

If you have requested a domain name during sign up then this will not be visible on the internet for between 24 and 72 hours. This process is called Propagation. Until your domain has Propagated your website and email will not function, we have provided a temporary url which you may use to view your website and upload files in the meantime.

Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,

The reseller hosting account for <?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
 has been set up. The username and password below are for both cPanel to manage the website at <?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
 and WebHostManager to manage your Reseller Account.

New Account Info

Domain: <?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

Username: <?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>

Password: <?php echo $_smarty_tpl->tpl_vars['service_password']->value;?>

Hosting Package: <?php echo $_smarty_tpl->tpl_vars['service_product_name']->value;?>


Control Panel: http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2082/
Web Host Manager: http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2086/

-------------------------------------------------------------------------------------------- 
Web Host Manager Quick Start 
-------------------------------------------------------------------------------------------- 

To access your Web Host Manager, use the following address:

http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2086/

The http:// must be in the address line to connect to port :2086 
Please use the username/password given above. 

To Create a New Account 

The first thing you need to do is scroll down on the left and click on &#39Add Package&#39 so that you can create your own hosting packages. You cannot install a domain onto your account without first creating packages.

1. Click on &#39Create a New Account&#39 from the left hand side menu 
2. Put the domain in the &#39Domain&#39 box (no www or http or spaces ? just domainname.com). After putting in the domain, hit TAB and it will automatically create a username. Also, enter a password for the account.
3. Your package selection should be one that you created earlier 
4. Then press the create button 

This will give you a confirmation page (you should print this for your records)

Please do not click on anything that you are not sure what it does. Please do not try to alter the WHM Theme from the selection box - fatal errors may occur. 

-------------------------------------------------------------------------------------------- 

Temporarily you may use one of the addresses given below manage your web site

Temporary FTP Hostname: <?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>

Temporary Webpage URL: http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
/~<?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>
/
Temporary Control Panel: http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
/cpanel

Once your domain has Propagated

FTP Hostname: www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

Webpage URL: http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

Control Panel: http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
/cpanel
Web Host Manager: http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
/whm

Mail settings

Catch all email with your default email account

POP3 Host Address : mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

SMTP Host Address: mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

Username: <?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>

Password: <?php echo $_smarty_tpl->tpl_vars['service_password']->value;?>


Additional mail accounts that you add

POP3 Host Address : mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

SMTP Host Address: mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

Username : The FULL email address that you are picking up from (e.g. info@yourdomain.com). 
If your email client cannot accept a @ symbol, then you may replace this with a backslash .
Password : As specified in your control panel 

Thank you for choosing us.

<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}
