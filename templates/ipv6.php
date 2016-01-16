<?php

/**
 * @author Michal Hrusecky <michal@hrusecky.net>
 *
 * @copyright Copyright (c) 2015, Michal Hrusecky
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

?>
<form id="ocipv6" class="section">
    <h2>IPv6</h2>
    <p>
        <span class="info"><?php print ($l->t ('IPv6 allows you to access your ownCloud instance from anywhere in the world (where IPv6 is available).')); ?></span>
    </p>
    <h3>Available addresses</h3>
    <p>
        <span class="info"><?php print ($l->t ('Here you can find list of your IPv6 addresses if you have any. Those can be used to reach your ownCloud from internet. If you don\'t have one, you can enable Teredo to get one.')); ?></span>
    </p>
    <p id="ipv6addresses">
        <div id="ipv6-loading" class="icon-loading-small inlineblock"></div>
    </p>
    <h3>Teredo</h3>
    <p>
        <span class="info"><?php print ($l->t ('Teredo is one of the simplest way to obtain IPv6 address. This address can change.')); ?></span>
    </p>
    <p>
        <div id="teredo-loading" class="icon-loading-small inlineblock"></div>
        <input type="checkbox" name="enable_teredo" id="TeredoEnable" class="checkbox" />
        <label for="TeredoEnable">Allow box to get IPv6 via Teredo</label><br/>
    </p>
</form>
