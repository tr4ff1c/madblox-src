<?php   
    function get_signature($script)
    {
        $signature = "";
        openssl_sign($script, $signature, file_get_contents($_SERVER["DOCUMENT_ROOT"] . "./joining/theitalways131514365287.pem"), OPENSSL_ALGO_SHA1);
        return base64_encode($signature);
    }
?>