<?php
use Illuminate\Database\Capsule\Manager as Capsule;
add_hook('AdminAreaHeaderOutput', 1, function($vars) {
	//echo '<pre>'; print_r($vars); die();
    $return = '';
    if ($vars['filename'] == 'configaddonmods') {
        $addondata = Capsule::table('tbladdonmodules')->where('module','ResellerAutomaticAPI')->where('setting', 'salt')->get();
//echo '<pre>'; print_r($addondata); die();
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+?<>';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 16; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $newsalt = implode($pass);
if(empty($addondata))
{
 
            Capsule::table('tbladdonmodules')->insert(['module'=>'ResellerAutomaticAPI', 'setting'=>'salt', 'value' => $newsalt]);
            ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script type="text/javascript">
            	$(document).find('input["name=fields[ResellerAutomaticAPI][salt]"]').val('<?php echo $newsalt; ?>')
            </script>
            <?php 
}
else
{
	if(empty($addondata[0]->value))
        {
            
            Capsule::table('tbladdonmodules')->where('module','ResellerAutomaticAPI')->where('setting', 'salt')->update(['value' => $newsalt]);
            ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script type="text/javascript">
            	$(document).find('input["name=fields[ResellerAutomaticAPI][salt]"]').val('<?php echo $newsalt; ?>')
            </script>
            <?php
        }
}
        
    }
    return $return;
});

