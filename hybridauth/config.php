<?php
/**
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2014, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return
    [
        // Your sites URL goes here
        // http://mywebsite.com/hybrid.php
        "base_url"   => "http://your_dns/hybrid.php",
        "providers"  => [
            // Instruccions: http://hybridauth.sourceforge.net/userguide/IDProvider_info_Google.html
            "Google"   => [
                "enabled" => true,
                "keys"    => [ "id" => "", "secret" => "" ],
            ],
            // Instruccions: http://hybridauth.sourceforge.net/userguide/IDProvider_info_Facebook.html
            "Facebook" => [
                "enabled"        => true,
                "keys"           => [ "id" => "", "secret" => "" ],
                'scope'   => 'email',
                'trustForwarded' => false
            ],
            // Instruccions: http://hybridauth.sourceforge.net/userguide/IDProvider_info_Google.html
            "Twitter"  => [
                "enabled" => true,
                "keys"    => [ "key" => "", "secret" => "" ]
            ],
        ],
        // If you want to enable logging, set 'debug_mode' to true.
        // You can also set it to
        // - "error" To log only error messages. Useful in production
        // - "info" To log info and error messages (ignore debug messages)
        "debug_mode" => false,
        // Path to file writable by the web server. Required if 'debug_mode' is not false
        "debug_file" => "bug.txt",
    ];
