<?php

// Start Session
    session_start();

    // SETTINGS BRANCH

    // search DEVCHANGETHIS for things that need looking at -jonfinley


// Log out if requested << not setup DEVCHANGETHIS
    if (isset($_GET['logout']) and isset($_SESSION['loged-in'])) {
        unset($_SESSION['loged-in']);
        header('Location: index.php');
        die;
    }

// Defining constants
    define('MON_PATH', '');
    define('MON_INCLUDE_PATH', MON_PATH.'assets/php/');
    define('MON_CONFIGURATION_PATH', MON_PATH.'assets/config/');
    define('MON_LANGUAGES_PATH', MON_PATH.'assets/languages/');
    define('MON_CSS_PATH', MON_PATH.'assets/css/');
    define('MON_JS_PATH', MON_PATH.'assets/js/');
    define('MON_TEMPLATES_PATH', MON_PATH.'assets/templates/');
    define('MON_FONTS_PATH', MON_PATH.'assets/fonts/');
    // define('MON_IMGCACHE_PATH', MON_PATH.'assets/cache/');
    define('MON_BASE_PATH', $_SERVER['SCRIPT_NAME']);

// Defining runtime variables and setting standard details
    $monConfiguration = array(
        'general' => array(), // internal info, dev and program info
        'usersettings' => array(), // user changeable settings
        'monitorrsettings' => array(),
        'services' => array(), //
    );

    if (isset($_GET['section'])) {
        $monConfigurationSection = $_GET['section'];
    }
    else {
        $monConfigurationSection = 'usersettings';
    }

    $monSomethingToSave = false;

    $monConfigurationSettings = array(

        'general' => array( // GENERIC INFO NOT TO BE CHANGED EXCEPT BY DEV
            'name' => 'General Information',
            'description' => 'Information about your Installation',
            'settings' => array(
                'script_name' => array(
                    'name' => 'Program Name',
                    'help' => '',
                    'type' => '',
                    'default' => 'Monitorr'
                ),
                'script_description' => array(
                    'name' => 'Description',
                    'help' => '',
                    'type' => 'info',
                    'default' => 'WE MONITORR YOUR SHIT!!!', //DEVCHANGETHIS
                ),
                'script_version' => array(
                    'name' => 'Version',
                    'help' => '',
                    'type' => 'info',
                    'default' => '' //DEVCHANGETHIS
                ),
                'script_guid' => array( //DEVCHANGETHIS is this even needed?
                    'name' => 'GUID',
                    'help' => 'Globally Unique IDentifier of the script',
                    'type' => 'info',
                    'default' => ''
                ),
            ),
        ),
        'usersettings' => array( // MAIN USER SETTINGS
            'name' => 'User Settings',
            'description' => 'Monitorr User Settings',
            'settings' => array(

                'title' => array( // DEVCHANGETHIS
                    'name' => 'Site Title',
                    'help' => 'Title to be shown in the header',
                    'type' => 'string',
                    'default' => 'monitorr',
                ),

                'siteurl' => array( // DEVCHANGETHIS
                    'name' => 'Site URL',
                    'help' => 'URL that links from the Site Header (must include "http(s)://")',
                    'type' => 'string',
                    'default' => 'http://localhost/monitorr/index.php',
                ),

                'admin_password' => array(
                    'name' => 'Administator Password',
                    'help' => 'Administator Password to access this settings page',
                    'type' => 'string',
                    'default' => 'monitorr',
                ),

                'language' => array(
                    'name' => 'Language',
                    'help' => 'Select the language of the program (not yet implemented)',
                    'type' => 'disabled',
                    'default' => 'en',
                ),

                'timezone' => array(
                    'name' => 'Timezone',
                    'help' => 'Choose your Timezone ', //should look at autopopulating this on Linux
                    'type' => 'single_option',
                    'options' => array(

                        "(GMT-11:00) Samoa" 	=>	'US/Samoa' ,
                        "(GMT-10:00) Hawaii"	=>	  'US/Hawaii' ,
                        "(GMT-09:00) Alaska" 	=>	'US/Alaska' ,
                        "(GMT-08:00) Pacific Time"	=>	  'US/Pacific' ,
                        "(GMT-07:00) Mountain Time" 	=>	'US/Mountain' ,
                        "(GMT-07:00) Chihuahua" 	=>	'America/Chihuahua' ,
                        "(GMT-07:00) Mazatlan" 	=>	'America/Mazatlan' ,
                        "(GMT-06:00) Mexico City" 	=>	'America/Mexico_City' ,
                        "(GMT-06:00) Monterrey" 	=>	'America/Monterrey' ,
                        "(GMT-06:00) Saskatchewan" 	=>	'Canada/Saskatchewan' ,
                        "(GMT-06:00) Central Time" 	=>	'US/Central' ,
                        "(GMT-05:00) Eastern Time "	=>	  'US/Eastern' ,
                        "(GMT-05:00) Indiana (East)" 	=>	'US/East-Indiana' ,
                        "(GMT-05:00) Bogota" 	=>	'America/Bogota' ,
                        "(GMT-05:00) Lima" 	=>	'America/Lima' ,
                        "(GMT-04:30) Caracas" 	=>	'America/Caracas' ,
                        "(GMT-04:00) Atlantic Time (Canada)" 	=>	'Canada/Atlantic' ,
                        "(GMT-04:00) La Paz" 	=>	'America/La_Paz' ,
                        "(GMT-04:00) Santiago" 	=>	'America/Santiago' ,
                        "(GMT-03:30) Newfoundland" 	=>	'Canada/Newfoundland' ,
                        "(GMT-03:00) Buenos Aires" 	=>	'America/Buenos_Aires' ,
                        "(GMT-03:00) Greenland" 	=>	'Greenland' ,
                        "(GMT-02:00) Stanley" 	=>	'Atlantic/Stanley', 
                        "(GMT-01:00) Azores" 	=>	'Atlantic/Azores' ,
                        "(GMT-01:00) Cape Verde Is." 	=>	'Atlantic/Cape_Verde' ,
                        "(GMT) Casablanca" 	=>	'Africa/Casablanca' ,
                        "(GMT) Dublin" 	=>	'Europe/Dublin' ,
                        "(GMT) Lisbon" 	=>	'Europe/Lisbon' ,
                        "(GMT) London"	=>	  'Europe/London' ,
                        "(GMT) Monrovia" 	=>	'Africa/Monrovia' ,
                        "(GMT+01:00) Amsterdam" 	=>	'Europe/Amsterdam' ,
                        "(GMT+01:00) Belgrade" 	=>	'Europe/Belgrade' ,
                        "(GMT+01:00) Berlin" 	=>	'Europe/Berlin' ,
                        "(GMT+01:00) Bratislava" 	=>	'Europe/Bratislava' ,
                        "(GMT+01:00) Brussels" 	=>	'Europe/Brussels' ,
                        "(GMT+01:00) Budapest" 	=>	'Europe/Budapest' ,
                        "(GMT+01:00) Copenhagen" 	=>	'Europe/Copenhagen' ,
                        "(GMT+01:00) Ljubljana" 	=>	'Europe/Ljubljana' ,
                        "(GMT+01:00) Madrid" 	=>	'Europe/Madrid' ,
                        "(GMT+01:00) Paris" 	=>	'Europe/Paris' ,
                        "(GMT+01:00) Prague" 	=>	'Europe/Prague' ,
                        "(GMT+01:00) Rome" 	=>	'Europe/Rome' ,
                        "(GMT+01:00) Sarajevo" 	=>	'Europe/Sarajevo' ,
                        "(GMT+01:00) Skopje" 	=>	'Europe/Skopje' ,
                        "(GMT+01:00) Stockholm" 	=>	'Europe/Stockholm' ,
                        "(GMT+01:00) Vienna" 	=>	'Europe/Vienna' ,
                        "(GMT+01:00) Warsaw" 	=>	'Europe/Warsaw' ,
                        "(GMT+01:00) Zagreb" 	=>	'Europe/Zagreb' ,
                        "(GMT+02:00) Athens" 	=>	'Europe/Athens' ,
                        "(GMT+02:00) Bucharest" 	=>	'Europe/Bucharest' ,
                        "(GMT+02:00) Cairo" 	=>	'Africa/Cairo' ,
                        "(GMT+02:00) Harare" 	=>	'Africa/Harare' ,
                        "(GMT+02:00) Helsinki" 	=>	'Europe/Helsinki' ,
                        "(GMT+02:00) Istanbul" 	=>	'Europe/Istanbul' ,
                        "(GMT+02:00) Jerusalem" 	=>	'Asia/Jerusalem' ,
                        "(GMT+02:00) Kyiv" 	=>	'Europe/Kiev' ,
                        "(GMT+02:00) Minsk" 	=>	'Europe/Minsk' ,
                        "(GMT+02:00) Riga" 	=>	'Europe/Riga' ,
                        "(GMT+02:00) Sofia" 	=>	'Europe/Sofia' ,
                        "(GMT+02:00) Tallinn" 	=>	'Europe/Tallinn' ,
                        "(GMT+02:00) Vilnius" 	=>	'Europe/Vilnius' ,
                        "(GMT+03:00) Baghdad" 	=>	'Asia/Baghdad' ,
                        "(GMT+03:00) Kuwait" 	=>	'Asia/Kuwait' ,
                        "(GMT+03:00) Nairobi" 	=>	'Africa/Nairobi' ,
                        "(GMT+03:00) Riyadh" 	=>	'Asia/Riyadh' ,
                        "(GMT+03:00) Moscow" 	=>	'Europe/Moscow' ,
                        "(GMT+03:30) Tehran" 	=>	'Asia/Tehran' ,
                        "(GMT+04:00) Baku" 	=>	'Asia/Baku' ,
                        "(GMT+04:00) Volgograd" 	=>	'Europe/Volgograd' ,
                        "(GMT+04:00) Muscat" 	=>	'Asia/Muscat' ,
                        "(GMT+04:00) Tbilisi" 	=>	'Asia/Tbilisi' ,
                        "(GMT+04:00) Yerevan" 	=>	'Asia/Yerevan' ,
                        "(GMT+04:30) Kabul" 	=>	'Asia/Kabul' ,
                        "(GMT+05:00) Karachi" 	=>	'Asia/Karachi' ,
                        "(GMT+05:00) Tashkent" 	=>	'Asia/Tashkent' ,
                        "(GMT+05:30) Kolkata" 	=>	'Asia/Kolkata' ,
                        "(GMT+05:45) Kathmandu" 	=>	'Asia/Kathmandu' ,
                        "(GMT+06:00) Ekaterinburg" 	=>	'Asia/Yekaterinburg' ,
                        "(GMT+06:00) Almaty" 	=>	'Asia/Almaty' ,
                        "(GMT+06:00) Dhaka" 	=>	'Asia/Dhaka' ,
                        "(GMT+07:00) Novosibirsk" 	=>	'Asia/Novosibirsk' ,
                        "(GMT+07:00) Bangkok" 	=>	'Asia/Bangkok' ,
                        "(GMT+07:00) Jakarta" 	=>	'Asia/Jakarta' ,
                        "(GMT+08:00) Krasnoyarsk" 	=>	'Asia/Krasnoyarsk' ,
                        "(GMT+08:00) Chongqing" 	=>	'Asia/Chongqing' ,
                        "(GMT+08:00) Hong Kong" 	=>	'Asia/Hong_Kong' ,
                        "(GMT+08:00) Kuala Lumpur" 	=>	'Asia/Kuala_Lumpur' ,
                        "(GMT+08:00) Perth" 	=>	'Australia/Perth' ,
                        "(GMT+08:00) Singapore" 	=>	'Asia/Singapore' ,
                        "(GMT+08:00) Taipei" 	=>	'Asia/Taipei' ,
                        "(GMT+08:00) Ulaan Bataar" 	=>	'Asia/Ulaanbaatar' ,
                        "(GMT+08:00) Urumqi" 	=>	'Asia/Urumqi' ,
                        "(GMT+09:00) Irkutsk" 	=>	'Asia/Irkutsk' ,
                        "(GMT+09:00) Seoul" 	=>	'Asia/Seoul' ,
                        "(GMT+09:00) Tokyo" 	=>	'Asia/Tokyo' ,
                        "(GMT+09:30) Adelaide" 	=>	'Australia/Adelaide' ,
                        "(GMT+09:30) Darwin" 	=>	'Australia/Darwin' ,
                        "(GMT+10:00) Yakutsk" 	=>	'Asia/Yakutsk' ,
                        "(GMT+10:00) Brisbane" 	=>	'Australia/Brisbane' ,
                        "(GMT+10:00) Canberra" 	=>	'Australia/Canberra' ,
                        "(GMT+10:00) Guam" 	=>	'Pacific/Guam' ,
                        "(GMT+10:00) Hobart" 	=>	'Australia/Hobart' ,
                        "(GMT+10:00) Melbourne" 	=>	'Australia/Melbourne' ,
                        "(GMT+10:00) Port Moresby" 	=>	'Pacific/Port_Moresby' ,
                        "(GMT+10:00) Sydney" 	=>	'Australia/Sydney' ,
                        "(GMT+11:00) Vladivostok" 	=>	'Asia/Vladivostok' ,
                        "(GMT+12:00) Magadan" 	=>	'Asia/Magadan' ,
                        "(GMT+12:00) Auckland" 	=>	'Pacific/Auckland' ,
                        "(GMT+12:00) Fiji "	=>	  'Pacific/Fiji' ,
                    ),
                    'default' => 'Europe/London',
                ),

                'timestandard' => array(
                    'name' => 'Time Standard',
                    'help' => '12 hour or 24 hour clock display',
                    'type' => 'single_option',
                    'options' => array(
                        'True (12 hour)' => 'true', 
                        'False (24 hour)' => 'false', 
                    ),
                    'default' => 'false',
                ),

                'settings_link' => array(
                    'name' => 'Settings Link',
                    'help' => 'Show link to Settings section in on mainpage', //DEVCHANGETHIS
                    'type' => 'bolean',
                    'default' => '1',
                ),

                'debug' => array( //DEVCHANGETHIS
                    'name' => 'Debug',
                    'help' => 'Show link with debug information (CAUTION: this will expose your token!)<br />Will also turn on/off PHP error reporting',
                    'type' => 'bolean',
                    'default' => 'false',
                ),

                'githubtoken' => array( // DEVCHANGETHIS
                    'name' => 'Github OAuth token',
                    'help' => 'OAuth2 token for access to github, to avoid 60/hr rate limit',
                    'type' => 'string',
                    'default' => 'x'
                ),
            ),
        ),
        'monitorrsettings' => array( // ADVANCED USER SETTINGS
            'name' => 'Monitorr Settings',
            'description' => 'Monitorr Settings',
            'settings' => array(
                'updatebranch' => array( //DEVCHANGETHIS
                    'name' => 'Update Branch',
                    'help' => 'GitHub repository branch for updates',
                    'type' => 'single_option',
                    'options' => array(
                        'Master' => 'Master', // DEVCHANGETHIS
                        'develop' => 'Develop' // DEVCHANGETHIS
                    ),
                    'default' => 'master'
                ),

                'rfsysinfo' => array( // DEVCHANGETHIS
                    'name' => 'Services Refresh',
                    'help' => 'Services & system resources check interval (in milliseconds)',
                    'type' => 'string',
                    'default' => '10000',
                ),

                'rftime' => array( // DEVCHANGETHIS
                    'name' => 'Time Refresh',
                    'help' => 'Display clock refresh interval (in milliseconds)',
                    'type' => 'string',
                    'default' => '5000',
                ),

                'pinghost' => array( // DEVCHANGETHIS
                    'name' => 'Ping Host',
                    'help' => 'URL or IP to ping',
                    'type' => 'string',
                    'default' => '8.8.8.8'
                ),

                'pingport' => array( // DEVCHANGETHIS
                    'name' => 'Ping Port',
                    'help' => 'Port to ping (defaults to 53)',
                    'type' => 'string',
                    'default' => '53'
                ),

                'cpuok' => array( // DEVCHANGETHIS
                    'name' => 'CPU Good',
                    'help' => 'CPU% less than this will be green',
                    'type' => 'string',
                    'default' => '50',
                ),

                'cpuwarn' => array( // DEVCHANGETHIS
                    'name' => 'CPU Warn',
                    'help' => 'CPU% less than this will be yellow',
                    'type' => 'string',
                    'default' => '90',
                ),

                'ramok' => array( // DEVCHANGETHIS
                    'name' => 'RAM Good',
                    'help' => 'RAM% less than this will be green',
                    'type' => 'string',
                    'default' => '50',
                ),

                'ramwarn' => array( // DEVCHANGETHIS
                    'name' => 'RAM Warn',
                    'help' => 'RAM% less than this will be yellow',
                    'type' => 'string',
                    'default' => '90',
                ),

                'coloron' => array( // DEVCHANGETHIS
                    'name' => 'Online Color',
                    'help' => 'This is the color that shows when service is online',
                    'type' => 'string',
                    'default' => 'x' // will need to rewrite this
                ),

                'coloroff' => array( // DEVCHANGETHIS
                    'name' => 'Offline Color',
                    'help' => 'This is the color that shows when service is offline',
                    'type' => 'string',
                    'default' => 'x' // will need to rewrite this
                ),

                'bgcolor' => array( // DEVCHANGETHIS
                    'name' => 'Background Color',
                    'help' => 'This is the color that shows one the background',
                    'type' => 'string',
                    'default' => 'x' // will need to rewrite this
                ),

                'tilecolor' => array( // DEVCHANGETHIS
                    'name' => 'Tile Color',
                    'help' => 'This is the  tile color that shows one the background',
                    'type' => 'string',
                    'default' => 'x' // will need to rewrite this
                ),

                'tileshadowcolor' => array( // DEVCHANGETHIS
                    'name' => 'Tile Shadow Color',
                    'help' => 'This is the  tile Shadow color',
                    'type' => 'string',
                    'default' => 'x' // will need to rewrite this
                ),

                'textcolor' => array( // DEVCHANGETHIS
                    'name' => 'Text Color',
                    'help' => 'This is the Text color on the main page',
                    'type' => 'string',
                    'default' => 'x' // will need to rewrite this
                ),

                'textshadowcolor' => array( // DEVCHANGETHIS
                    'name' => 'Text Shadow Color',
                    'help' => 'This is the text shadow color on the main page',
                    'type' => 'string',
                    'default' => 'x' // will need to rewrite this
                ),
            ),
        ),

        // NEWEService script goes here:


        'services' => array( 
            'name' => 'services',
            'Content' => 'test test test',
            
            $monOutput['Content'] .= '	<div>'.PHP_EOL,
            $monOutput['Content'] .= '	test'.PHP_EOL,
            $monOutput['Content'] .= '	</div>'.PHP_EOL,

             $monOutput = array(
                'Content'   => '	test'.PHP_EOL,
             ),

         // NEWEService script goes ABOVE THIS

        ),
    );

      
    
//$mon_strings = array();
    $monErrors = array();
    $monOutput = array(
        'Title' => '',
        'Errors' => '',
        'Menu' => '',
        'Content' => '',
        'Script' => '',
        'Include' => '',
    );
    $mon_token = '';

// Include functions and classes DEVCHANGETHIS to something
    include(MON_INCLUDE_PATH.'mon.functions.php');
    include(MON_INCLUDE_PATH.'mon.classes.php');
    // include(MON_INCLUDE_PATH.'class.plexAPI.php');


    if (!is_writable(MON_CONFIGURATION_PATH)) {
        $monErrors[] = MON_CONFIGURATION_PATH.' must be writable!!!';
        $monOutput['Title'] = 'Monitorr - Settings';
    }
    else {

	// Generate default config files
        foreach ($monConfigurationSettings as $key => $value) {
            if (!file_exists(MON_CONFIGURATION_PATH.$key.'.json')) {
                foreach ($value['settings'] as $setting => $setting_value) {
                    $monConfiguration[$key][$setting] = $setting_value['default'];
                }
                $success = json_write($monConfiguration, MON_CONFIGURATION_PATH, $key);
                if ($success[$key] == 'true') {
                    $monNotifications[] = 'Configuration file "'.MON_CONFIGURATION_PATH.$key.'.json" successfully generated!';
                //	chmod(mon_CONFIGURATION_PATH.$key.'.json', 0666);
                }
                else {
                    foreach ($success[$key] as $error_key => $errorValue) {
                        $monErrors[] = $errorValue;
                    }
                }
            }
        }

	// Load configuration files
        $monConfiguration = json_load($monConfiguration, MON_CONFIGURATION_PATH, '');
        foreach ($monConfiguration as $key => $details) {
            if (empty($monConfiguration[$key])) {
                $monErrors[] = 'Unable to load configuration file "'.MON_CONFIGURATION_PATH.$key.'.json"!';
            }
            else {
                // Something to do here?
            }
        }

	// Setting Error level
        if ($monConfiguration['usersettings']['debug']) {
            error_reporting(-1);
            ini_set("display_errors", 1);
            // Register error handler
            set_error_handler("error_handler");
            set_exception_handler("error_handler");
            register_shutdown_function("error_handler");
        }
        else {
            error_reporting(0);
            ini_set('display_errors','Off');
        }


	// Generate guid if not yet set
        if (empty($monConfiguration['general']['script_guid'])) {
            $monConfiguration['general']['script_guid'] = generateGUID(); //leftovers doesnt matter
            $success = json_write($monConfiguration, MON_CONFIGURATION_PATH, 'general');
            if ($success['general'] == 'true') {
                $monNotifications[] = 'Configuration file "'.MON_CONFIGURATION_PATH.'general.json" successfully updated with new GUID!';
                //	chmod(MON_CONFIGURATION_PATH.$key.'.json', 0666);
            }
            else {
                foreach ($success['general'] as $error_key => $errorValue) {
                    $monErrors[] = $errorValue;
                }
            }
        }


	// Saving the settings
        if (isset($_POST['section'])) {

            foreach ($_POST as $key => $value) {
                if ($key <> 'section'){
                    unset($monConfiguration[$_POST['section']][$key]);
                    $monConfiguration[$_POST['section']][$key] = $value;
                }
            }

            $success = json_write($monConfiguration, MON_CONFIGURATION_PATH, $_POST['section']);
            if ($success[$_POST['section']] == 'true') {
                $monNotifications[] = 'Configuration file "'.MON_CONFIGURATION_PATH.$_POST['section'].'.json" successfully saved!';
            }
            else {
                foreach ($success[$_POST['section']] as $key => $value) {
                    $monErrors[] = $value;
                }
            }

            // Reload configuration files
            $monConfiguration = json_load($monConfiguration, MON_CONFIGURATION_PATH, '');
            foreach ($monConfiguration as $key => $details) {
                if (empty($monConfiguration[$key])) {
                    $monErrors[] = 'Unable to load configuration file "'.MON_CONFIGURATION_PATH.$key.'.json"!';
                }
                else {
                    // Something to do here?
                }
            }
        }

	// Authenticate the administrator
        if (!isset($_SESSION['loged-in'])) {
            if (isset($_POST['settings_password'])) {
                if ($_POST['settings_password'] == $monConfiguration['usersettings']['admin_password']) {
                    $_SESSION['loged-in'] = true;
                }
                else {
                    $monErrors[] = 'Wrong Administrator Password!';
                }
            }
        }
    
	// EMPTY SETTINGS - ESTABLISH ADMIN PASSWORD
        if (empty($monConfiguration['usersettings']['admin_password'])) {
            $monOutput['Content'] .= '<form class="form-horizontal" action="'.MON_BASE_PATH.'" method="post">'.PHP_EOL;
            $monOutput['Content'] .= '<fieldset>'.PHP_EOL;
            $monOutput['Content'] .= '<legend>Setting Administrator Password</legend>'.PHP_EOL;
            $monOutput['Content'] .= '	<fieldset class="form-group">'.PHP_EOL;
            $monOutput['Content'] .= '		<label class="col-md-1 control-label" for="admin_password">Administrator Password</label>'.PHP_EOL;
            $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
            $monOutput['Content'] .= '			<input id="admin_password" name="admin_password" type="text" placeholder="" value="" class="form-control input-md" required="">'.PHP_EOL;
            $monOutput['Content'] .= '			<span class="help-block">Please set your Administartor Password to access the Settings section</span>'.PHP_EOL;
            $monOutput['Content'] .= '		</div>'.PHP_EOL;
            $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;
            $monOutput['Content'] .= '	<fieldset class="row form-group">'.PHP_EOL;
            $monOutput['Content'] .= '		<div class="col-md-1">'.PHP_EOL;
            $monOutput['Content'] .= '			<input type="hidden" name="section" id="section" value="usersettings">'.PHP_EOL;
            $monOutput['Content'] .= '		</div>'.PHP_EOL;
            $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
            $monOutput['Content'] .= '			<input class="btn btn-primary" type="submit" value="Save">'.PHP_EOL;
            $monOutput['Content'] .= '		</div>'.PHP_EOL;
            $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;
            $monOutput['Content'] .= '</fieldset>'.PHP_EOL;
            $monOutput['Content'] .= '</form>'.PHP_EOL;
        }
        else if (!isset($_SESSION['loged-in'])) {
            $monOutput['Content'] .= '<form class="form-horizontal" action="'.MON_BASE_PATH.'" method="post">'.PHP_EOL;
            $monOutput['Content'] .= '<fieldset>'.PHP_EOL;
            $monOutput['Content'] .= '<legend>Login</legend>'.PHP_EOL;
            $monOutput['Content'] .= '	<fieldset class="form-group">'.PHP_EOL;
            $monOutput['Content'] .= '		<label class="col-md-1 control-label" for="settings_password">Administrator Password</label>'.PHP_EOL;
            $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
            $monOutput['Content'] .= '			<input id="password" name="settings_password" type="settings_password" placeholder="" value="" class="form-control input-md" required="">'.PHP_EOL;
            $monOutput['Content'] .= '			<span class="help-block">Please enter your Administartor Password to access the Settings section</span>'.PHP_EOL;
            $monOutput['Content'] .= '		</div>'.PHP_EOL;
            $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;
            $monOutput['Content'] .= '	<fieldset class="form-group">'.PHP_EOL;
            $monOutput['Content'] .= '		<div class="col-md-1"></div>'.PHP_EOL;
            $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
            $monOutput['Content'] .= '			<input class="btn btn-primary" type="submit" value="Submit">'.PHP_EOL;
            $monOutput['Content'] .= '		</div>'.PHP_EOL;
            $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;
            $monOutput['Content'] .= '</fieldset>'.PHP_EOL;
            $monOutput['Content'] .= '</form>'.PHP_EOL;
        }
        else if (isset($_SESSION['loged-in'])) {
            $monOutput['Content'] .= '<form class="form-horizontal" action="'.MON_BASE_PATH.'?section='.$monConfigurationSection.'" method="post">'.PHP_EOL;
            $monOutput['Content'] .= '<fieldset>'.PHP_EOL;
            $monOutput['Content'] .= '<legend>'.$monConfigurationSettings[$monConfigurationSection]['description'].'</legend>'.PHP_EOL;

	// Creating the settings menu
        foreach($monConfigurationSettings as $key => $value) {
            $monOutput['Menu'] .= '<li class="mon_menu';
            if ($key == $monConfigurationSection) {
                $monOutput['Menu'] .= ' mon_menu_selected selected';
            }
            $monOutput['Menu'] .= '"><a href="'.MON_BASE_PATH.'?section='.$key.'">';
            $monOutput['Menu'] .= '<span class="fa fa-gear fa-lg"></span>&nbsp;&nbsp;';
            $monOutput['Menu'] .= $value['name'].'</a></li>'.PHP_EOL;
        }

        // Construct NEW services page//WTF not working.
        // $monOutput['Menu'] .= '<li class="mon_menu"><a href="'.MON_BASE_PATH.'"><i class="fa fa-gear fa-lg"></i>&nbsp;&nbsp;ServicesNEW</a></li>'.PHP_EOL; 	// REDIRECT TO NEW SERVICES TABLE
        // $monOutput['Menu'] .= '<li class="mon_menu"><a href="'.MON_BASE_PATH.'?section='.$key.'"><i class="fa fa-gear fa-lg"></i>&nbsp;&nbsp;ServicesNEW</a></li>'.PHP_EOL; 	// REDIRECT TO NEW SERVICES TABLE
        
            if (!isset($_SESSION['loged-in'])) {

                $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
                $monOutput['Content'] .= '			<input class="btn btn-primary" type="submit" value="Submit">'.PHP_EOL;
                $monOutput['Content'] .= '		</div>'.PHP_EOL;
            }

        $monOutput['Menu'] .= '<li class="mon_menu"><a href="'.MON_BASE_PATH.'?logout=1"><i class="fa fa-sign-out fa-lg"></i>&nbsp;&nbsp;Log out</a></li>'.PHP_EOL;
        $monOutput['Menu'] .= '<li class="mon_menu"><a href="index.php"><i class="fa fa-home fa-lg"></i>&nbsp;&nbsp;Back to Frontend</a></li>'.PHP_EOL;

	// Creating the settings content
        foreach ($monConfigurationSettings[$monConfigurationSection]['settings'] as $key => $value) {

            if (isset($monConfiguration[$monConfigurationSection][$key])){
                $setting_value = $monConfiguration[$monConfigurationSection][$key];
            }
            else {
                $setting_value = $value['default'];
            }

            switch ($value['type']) {
                case 'string': {
                    $monOutput['Content'] .= '	<fieldset class="form-group">'.PHP_EOL;
                    $monOutput['Content'] .= '		<label class="col-md-1 control-label" for="'.$key.'">'.$value['name'].'</label>'.PHP_EOL;
                    $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
                    $monOutput['Content'] .= '			<input id="'.$key.'" name="'.$key.'" type="text" placeholder="" value="'.$setting_value.'" class="form-control input-md" required="">'.PHP_EOL;
                    $monOutput['Content'] .= '			<span class="help-block">'.$value['help'].'</span>'.PHP_EOL;
                    $monOutput['Content'] .= '		</div>'.PHP_EOL;
                    $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;
                    $monSomethingToSave = true;
                    break;
                }
                case 'disabled': {
                    $monOutput['Content'] .= '	<fieldset class="form-group">'.PHP_EOL;
                    $monOutput['Content'] .= '		<label class="col-md-1 control-label" for="'.$key.'">'.$value['name'].'</label>'.PHP_EOL;
                    $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
                    $monOutput['Content'] .= '			<input id="'.$key.'" name="'.$key.'" type="text" placeholder="" value="'.$setting_value.'" class="form-control input-md" disabled="">'.PHP_EOL;
                    $monOutput['Content'] .= '			<span class="help-block">'.$value['help'].'</span>'.PHP_EOL;
                    $monOutput['Content'] .= '		</div>'.PHP_EOL;
                    $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;

                    break;
                }
                case 'info': {
                    $monOutput['Content'] .= '	<fieldset class="form-group">'.PHP_EOL;
                    $monOutput['Content'] .= '		<label class="col-md-1 control-label" for="'.$key.'">'.$value['name'].'</label>'.PHP_EOL;
                    $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
                    $monOutput['Content'] .= '			<input type="text" placeholder="'.$setting_value.'" value="'.$setting_value.'" class="form-control input-md">'.PHP_EOL;
                    $monOutput['Content'] .= '			<span class="help-block">'.$value['help'].'</span>'.PHP_EOL;
                    $monOutput['Content'] .= '		</div>'.PHP_EOL;
                    $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;

                    break;
                }
                case 'bolean': {
                    if ($setting_value){
                        $checked_true = 'checked';
                        $checked_false = '';
                    }
                    else {
                        $checked_false = 'checked';
                        $checked_true = '';
                    }
                    $monOutput['Content'] .= '	<fieldset class="form-group">'.PHP_EOL;
                    $monOutput['Content'] .= '		<label class="col-md-1 control-label" for="'.$key.'">'.$value['name'].'</label>'.PHP_EOL;
                    $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
                    $monOutput['Content'] .= '			<div class="radio">'.PHP_EOL;
                    $monOutput['Content'] .= '				<label for="'.$key.'-0">'.PHP_EOL;
                    $monOutput['Content'] .= '				<input type="radio" name="'.$key.'" id="'.$key.'-0" value="1" '.$checked_true.'>True</label><br />'.PHP_EOL;
                    $monOutput['Content'] .= '				<label for="'.$key.'-1">'.PHP_EOL;
                    $monOutput['Content'] .= '				<input type="radio" name="'.$key.'" id="'.$key.'-1" value="0" '.$checked_false.'>False</label>'.PHP_EOL;
                    $monOutput['Content'] .= '			</div>'.PHP_EOL;
                    $monOutput['Content'] .= '			<span class="help-block">'.$value['help'].'</span>'.PHP_EOL;
                    $monOutput['Content'] .= '		</div>'.PHP_EOL;
                    $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;
                    $monSomethingToSave = true;
                    break;

                }

                    case 'single_option': {
                        $monOutput['Content'] .= '	<fieldset class="form-group">'.PHP_EOL;
                        $monOutput['Content'] .= '		<label class="col-md-1 control-label" for="'.$key.'">'.$value['name'].'</label>'.PHP_EOL;
                        $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
                        $monOutput['Content'] .= '			<select id="'.$key.'" name="'.$key.'" class="form-control">'.PHP_EOL;
                        foreach ($value['options'] as $options_key => $options_value){
                            if ($setting_value == $options_value) {
                                $selected = ' selected=""';
                            }
                            else {
                                $selected = '';
                            }
                            $monOutput['Content'] .= '				<option value="'.$options_value.'"'.$selected.'>'.$options_key.'</option>'.PHP_EOL;
                        }
                        $monOutput['Content'] .= '			</select>'.PHP_EOL;
                        $monOutput['Content'] .= '			<span class="help-block">'.$value['help'].'</span>'.PHP_EOL;
                        $monOutput['Content'] .= '		</div>'.PHP_EOL;
                        $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;
                        $monSomethingToSave = true;
                        break;
                    }
                    default: {

                    } 
                
            }
        }

        $monOutput['Content'] .= '	<fieldset class="form-group">'.PHP_EOL;
        $monOutput['Content'] .= '		<div class="col-md-1 control-label" for="">'.PHP_EOL;
        $monOutput['Content'] .= '			<input type="hidden" name="section" id="section" value="'.$monConfigurationSection.'">'.PHP_EOL;
        $monOutput['Content'] .= '		</div>'.PHP_EOL;
        $monOutput['Content'] .= '		<div class="col-md-4">'.PHP_EOL;
        if ($monSomethingToSave) {
            $monOutput['Content'] .= '			<input class="btn btn-primary" type="submit" value="Save">'.PHP_EOL;
        }
        $monOutput['Content'] .= '		</div>'.PHP_EOL;
        $monOutput['Content'] .= '	</fieldset>'.PHP_EOL;
        $monOutput['Content'] .= '</fieldset>'.PHP_EOL;
        $monOutput['Content'] .= '</form>'.PHP_EOL;

        }


        $monOutput['Include'] .= '	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">'.PHP_EOL;
        $monOutput['Include'] .= '	<link rel="stylesheet" type="text/css" href="assets/css/mon.css"/>'.PHP_EOL;

        $monOutput['Title'] = $monConfiguration['usersettings']['title'].' - Settings';
        }


    // Constructing the error messages
    
        if (!empty($monErrors)){
        foreach ($monErrors as $details) {
        $monOutput['Errors'] .= '<div class="monErrors alert alert-danger"><strong>Error:</strong> '.$details.'</div>'.PHP_EOL;
        }
        }

        if (!empty($monNotifications)){
        foreach ($monNotifications as $details) {
        $monOutput['Errors'] .= '<div class="monErrors alert alert-success alert-dismissible"><strong>Success:</strong> '.$details.'</div>'.PHP_EOL;
        }
        }

        $output = new Template(MON_TEMPLATES_PATH.'index.tpl');
        foreach ($monOutput as $key => $content){
        $output->set($key, $content);
        }
        echo $output->output();
    
 

?>
