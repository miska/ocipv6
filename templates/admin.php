<?php
/**
 * ownCloud - IPv6
 *
 */
?>
<form id="ipv6" class="section">
    <h2>IPv6</h2>
    <p>
        <span class="info"><?php print ($l->t ('IPv6 allows you to access your ownCloud instance from anywhere in the world (where IPv6 is available).')); ?></span>
    </p>
    <h3>Available adresses</h3>
    <p>
        <span class="info"><?php print ($l->t ('Here you can find list of your IPv6 addresses if you have any. Those can be used to reach your ownCloud from internet. If you don\'t have one, you can enable Teredo to get one.')); ?></span>
    </p>
    <p id="ipv6addresses">
    </p>
    <h3>Teredo</h3>
    <p>
        <span class="info"><?php print ($l->t ('Teredo is one of the simplest way to obtain IPv6 address. This address can change.')); ?></span>
    </p>
    <p>
        <input type="checkbox" name="enable_teredo" id="TeredoEnable" class="checkbox" />
        <label for="TeredoEnable">Allow box to get IPv6 via Teredo</label><br/>
    </p>
</form>
