#!/usr/bin/php
<?php
    function get_datas($url) {
        $id = curl_init();
        curl_setopt_array($id, [
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true
        ]);
        $datas = curl_exec($id);
        curl_close($id);
        return ($datas);
    }

    if ($argc > 1) {
        $html = get_datas($argv[1]);
        $url = preg_replace('/^https?:\/\//', '', $argv[1]);
        $url = array_shift(explode('/', $url));
        if (preg_match_all('/<img(.*?)src="(.*?)"/', $html, $matches) && !file_exists($url))
            mkdir($url);
        else
            exit();
        $matches = array_splice($matches, 2);
        foreach($matches[0] as $addr) {
            $img = get_datas($addr);
            $name = explode('/', $addr);
            file_put_contents("./" . $url . "/" . array_pop($name), $img);
        }
        
    }
?>