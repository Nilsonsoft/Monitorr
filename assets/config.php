    <!-- SETTINGS BRANCH -->
       
     <!--   
    "CONVERTED" means that front-end code (index.php) has been changed to NEW .JSON files 
    and is WORKING when changed from settings.php" 
    -->


<?php

$config = array(
 // **CONVERTED ** // 'title' => 'Monitorr',    // Site Title
 // **CONVERTED ** // 'siteurl' => 'http://localhost', // SITE URL
    'updateBranch' => 'develop', // update branch you wish to use // "master" or "develop"
 // **CONVERTED ** //    'timestandard' => 'False', // True for Standard Time, DEFAULT = False
// **CONVERTED ** //  'rftime' => '',  // time refresh
// **CONVERTED ** //  'rfsysinfo' => '5000', // system info refresh in milliseconds
    'pinghost' => '8.8.8.8', // URL or IP to ping
    'pingport' => '53', // port to ping (defaults to 53)
    'cpuok' => '50', //CPU% less than this will be green
    'cpuwarn' => '90', //CPU% less than this will be yellow
    'ramok' => '50', //RAM% below this is green
    'ramwarn' => '90', //RAM% below this will be yellow
// **CONVERTED ** // 'timezone' => 'PST',
    // if on Linux, the timezone script will automatically select your timezone
    // For Windows, set the timezone. Default is UTC Time.
    // I.E. ($timezone = 'America/Los_Angeles',) list of timezone: https://php.net/manual/en/timezones.php

    //    'coloron' => '', // color for online, WIP
    //    'coloroff' => '', // color for offline, WIP
 // **CONVERTED **  'githubtoken' => '', //OAuth2 token for access to github, to avoid 60/hr rate limit, see https://github.com/settings/tokens
);


$myServices = array(
    "Monitorr" => array(
        "link" => "http://localhost/monitorr",
        "image" => "monitorr.png"
        ),
    "PLEX" => array(
        "link" => "http://localhost:32400",
        "image" => "plex.png"
        ),
    "Sonarr" => array(
        "link" => "http://localhost:8989",
        "image" => "sonarr.png"
        ),
    "Radarr" => array(
        "link" => "http://localhost:7878",
        "image" => "radarr.png"
        ),
    "PlexPy" => array(
        "link" => "http://localhost:8181",
        "image" => "plexpy.png"
        ),
   );


?>
