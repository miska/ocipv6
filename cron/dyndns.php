<?php
namespace OCA\ocipv6\Cron;

use \OCA\ocipv6\AppInfo\Application;
use \OCA\ocipv6\Service\AuthorService;
use \OCA\OCIPv6\Controller;

class DynDNS {

    public static function update() {
        // system("echo '" . $as->getSystemValue('dbtype') . "' > /srv/www/htdocs/owncloud/test");
        $app = new Application();
        $c = $app->getContainer();
        $as = $c->query('OCA\OCIPv6\Service\AuthorService');
        $hostname = $as->getAppValue('hostname');
        $token = $as->getAppValue('token');
        $last_ip = $as->getAppValue('last_ip');
        if($hostname && $token && !empty($hostname) && !empty($token)) {
            exec("ip -6 a s scope global", $output, $ret);
            $current_ip = join($output);
            if($last_ip != $current_ip) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://dynv6.com/api/update?hostname=" . $hostname . "&ipv6=auto&token=" . $token);
                curl_setopt($ch, CURLOPT_HEADER, TRUE);
                curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $head = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                if($httpCode == 200) {
                    $as->setAppValue('last_ip', $current_ip);
                }
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://ipv4.dynv6.com/api/update?hostname=" . $hostname . '&ipv4=auto&token=' . $token);
                curl_setopt($ch, CURLOPT_HEADER, TRUE);
                curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $head = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
            }
        }
        $upnp = $as->getAppValue('upnp');
        $port = $as->getAppValue('upnp_port');
        if(preg_match('/^[0-9.]+$/', $upnp)) {
            exec("upnpc -l", $output, $ret);
            $intip = "";
            foreach($output as $i) {
                if(preg_match('/.*TCP[[:blank:]]*443->([0-9.]+):443/', $i, $match)) {
                    $intip = $match[1];
                }
            }
            if($intip != $upnp) {
                exec("upnpc -d 443 TCP", $output, $ret);
                exec("upnpc -d $port TCP", $output, $ret);
                exec("upnpc -a $upnp $port $port TCP", $output, $ret);
            }
        }
    }
}
