<?php
    
    echo "<b> //////////////// MONITORR /////////////// </b> <br />\n";
    echo "<b> <a href='https://github.com/monitorr/Monitorr' target='_blank'> https://github.com/monitorr/Monitorr </a> </b> <br />\n";

    echo "<br>"; 

    echo "Usage: <br />\n"; 
    echo "- This script uses CURL to check if a webpage is accessible at given URL. <br />\n";
    echo "- If CURL fails, use a PING (pfsockopen) function to check if the port is OPEN at given URL <br />\n";
    
    echo "<br>"; 

    echo "Notes: <br />\n"; 
    echo "- URL MUST contain a PORT after HOST. <br />\n";
    echo "- URL CAN include any protocol and sub-path. <br />\n";
    echo "- If HTTP status is between 200 and 400, generally all successes are in this range, the website is reachable. <br />\n";
    echo "- Checking URLs MAY take up to ~180 seconds depending on responses. <br />\n";  
    echo "<br>";   


    echo "<b> //////////////// check START: /////////////// </b> <br />\n";
    echo "<br>"; 
    
    
    // INSERT URL TO CHECK BELOW: //


     $url = 'https://google.com:443';


     // INSERT URL TO CHECK ABOVE: //


// * @param string $url URL that must be checked

    // convert URL to <host>:<port> for PING function:

    function url_to_domain($url) {


        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);
        $path = parse_url($url, PHP_URL_PATH);
        

            // If URL is invalid, response:
            
        if (!$host)

            echo "<br>";
            echo "<b> ////// Invalid URL ////// </b> <br />\n";
            echo "<br>";

            // $host = $url;

            // remove "http/s" and "www" :

        if (substr($host, 0, 4) == "www.")
            $host = substr($host, 4);

        if (strlen($host) > 50)
            $host = substr($host, 0, 47) . '...';

            // contruct sanitized URL, add ":port/path" to "HOST"

        return $host . ":" . $port . $path;

    } 

        echo "Input URL .......... $url<br />\n";
        echo "CURL URL ........ $url<br />\n";

        
        global $t;
        global $k;

        $handle = curl_init($url);

        curl_setopt($handle, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($handle, CURLOPT_FORBID_REUSE, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle, CURLOPT_HEADER, true);
        curl_setopt($handle, CURLOPT_NOBODY, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($handle, CURLOPT_TCP_FASTOPEN, true);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_TIMEOUT, 60);
        // curl_setopt($handle, CURLOPT_URL, $url);

        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $curlCode = curl_getinfo($handle, CURLINFO_RESPONSE_CODE);

            $response = curl_exec($handle);

            if($httpCode >= 200 && $httpCode < 400 || $httpCode == 401 || $httpCode == 403 || $httpCode == 405 || $curlCode == 8 || $curlCode == 67 || $curlCode == 530 || $curlCode == 60 ) {

                echo "CURL response .. HTTP : $httpCode / $curlCode <br />\n";
                echo "CURL ................. SUCCESS <br />\n";
                echo "</br>";
                echo "<b>Monitorr status .... ONLINE </b><br />\n";

                echo "</br>";

                echo "CURL response headers:";
                echo "</br>";

                //Receives full CURL headers:

                $output = curl_exec($handle);

                // close curl resource to free up system resources:

                curl_close($ch);

                $headers=array();

                $data=explode("\n",$output);

                $headers['status']=$data[0];

                array_shift($data);

                foreach($data as $part){
                    $middle=explode(":",$part);
                    $headers[trim($middle[0])] = trim($middle[1]);
                }

                //print all headers as array:

                echo "<pre>";
                print_r($headers);
                echo "</pre>";

                echo "<b> //////////////// check END /////////////// </b> <br />\n";

            } 


            //If CURL fails, use PING as fallback check:

            else {

                $url = (url_to_domain($url));

                $fp = fsockopen($url, $errno, $errstr, $timeout = 10);

                    if (!$fp) {

                        echo "Ping URL ........... $url <br />\n ";
                        echo "CURL ................. FAIL <br />\n";
                        echo "CURL Response .. $httpCode / $curlCode <br />\n";
                        echo "PING .................. FAIL <br />\n ";
                        echo "PING Response ... $errstr ($errno) <br />\n";
                        echo "URL status .......... CLOSED <br />\n";
                        echo "</br>";
                        echo "<b>Monitorr status .... OFFLINE </b><br />\n";
                        echo "</br>";
                        echo "<b> //////////////// check END /////////////// </b> <br />\n";
                        
                    } 
                
                    else {

                        $out = "GET / HTTP/1.1\r\n";
                        $out .= "$url\r\n";
                        $out .= "Connection: Close\r\n\r\n";
                        fwrite ($out);
                        

                        echo "Ping URL ............ $url <br />\n  ";
                        echo "CURL ................. FAIL <br />\n";
                        echo "CURL Response .. $httpCode / $curlCode <br />\n";
                        echo "PING .................. SUCCESS <br />\n ";
                        echo "URL status .......... OPEN <br />\n";
                        echo "</br>";
                        echo "<b>Monitorr status .... UNRESPONSIVE </b><br />\n";        
                        
                        echo "<br>";
                        
                        echo "PING response headers:";
                        echo "</br>";
                        echo "</br>";

                        echo "<b> //////////////// check END /////////////// </b> <br />\n";

                         //  displays header:  

                    while (!feof($fp)) {
                            echo fgets($fp, 128);
                        } 

                    }

                fclose($fp);

            }

        curl_close($handle);
    

?>

<p> <a href="https://github.com/monitorr/Monitorr" target="_blank"> Repo: Monitorr </a> // <a href="https://github.com/Monitorr/Monitorr/releases" target="_blank"> Version: <?php echo file_get_contents( "../../assets/js/version/version.txt" );?> </a> </p>

