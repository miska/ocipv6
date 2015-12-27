<?php
/**
 * ownCloud - IPv6
 */	

\OC_Util::checkAdminUser();

script('ipv6', 'ipv6');

$Tmpl = new OCP\Template('ipv6', 'admin');

return $Tmpl->fetchPage();

?>
