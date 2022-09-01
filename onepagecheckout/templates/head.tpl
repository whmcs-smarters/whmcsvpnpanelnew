<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php echo $title; ?>| <?php echo $tagline; ?></title>

<!-- Bootstrap -->
<script src="js/jquery.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="css/font-awesome.min.css">
<!----custom js--->
<script src="js/accounting.min.js"></script>
<!--<script src="js/custom.js"></script>-->


<script src="js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
<script src="js/countries.js"></script>

<link rel="stylesheet" type="text/css" href="css/squareradio.css" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />

            <script type="text/javascript" src="js/icheck.js"></script>
            <script src="onepagecart/assets/js/onepagecart.js" type="text/javascript"></script>
            <script>
                $(document).ready(function() {
                    
                    var callbacks_list = $('.demo-callbacks ul');
                    $('.iradiobox').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event) {
                        callbacks_list.prepend('<li><span>#' + this.id + '</span> is ' + event.type.replace('if', '').toLowerCase() + '</li>');
                    }).iCheck({
                        checkboxClass: 'icheckbox_square-blue',
                        radioClass: 'iradio_square-blue',
                        increaseArea: '20%'
                    });
                    $(document).on('ifChecked', '.configoption_checkbox', function(event) {
                            opcupdate(); 
                    });
                    $(document).on('ifUnchecked', '.configoption_checkbox', function(event) {
                            opcupdate(); 
                    });
                    $(document).on('ifChecked', '.configoption_radio', function(event) {
                            opcupdate(); 
                    });
                    
                    
                    $(document).on('ifChecked', '.customfiled-checkbox', function(event) {
                            opcupdate(); 
                    });
                    $(document).on('ifUnchecked', '.customfiled-checkbox', function(event) {
                            opcupdate(); 
                    });
                 
                });
            </script>