<?php
session_start();
define('SITEURL', 'http://172.21.12.73/mPatient/patient#');
define('BASEURL', 'http://172.21.12.73/mPatient/');
define('FIRSTKEY', 'Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4');
define('SECONDKEY', 'EZ44mFi3TlAey1b2w4Y7lVDuqOSRxGXsa7nctnrJmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFKo9Y5c83w');
function encode($value) {
        if (!$value) {
                return false;
        }
        
        $encrypt_method = "AES-256-CBC";
        $secret_key = FIRSTKEY;
        $secret_iv = SECONDKEY;

        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        // if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($value, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        
        return $output ;
}

function decode($value) {
        if (!$value) {
                return false;
        }
        
        $encrypt_method = "AES-256-CBC";
        $secret_key = FIRSTKEY;
        $secret_iv = SECONDKEY;
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($value), $encrypt_method, $key, 0, $iv);
        return $output;
}

/** The name of the database for WordPress */
// define( 'DB_NAME', 'dm_transcribe' );
/** MySQL database username */
// define( 'DB_USER', 'dm_transcribe_db_user' );
/** MySQL database password */
// define( 'DB_PASSWORD', 'oLxKn0*lLV0i*' );
/** MySQL hostname */
// define( 'DB_HOST', 'localhost' );

//define('SMTP_HOST', 'email-smtp.ap-south-1.amazonaws.com');
//define('SMTP_PORT', 465);
//define('SMTP_USERNAME', "AKIA5AYNAJZP36TDZF35");
//define('SMTP_PASS', "BOZEsCl9f69UN7ly9qqJa9D+2i4Njg0//kjwyEddtMyZ");
//define('SMTP_FROM', "support@chargedrive.in");
//define('SERVER_ADDR', "13.126.214.63");



//define('GOOGLE_KEY', '/L8ms~k!');
        /* a
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

