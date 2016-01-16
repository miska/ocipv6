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
<form id="ocipv6upnp" class="section">
    <h2>uPnP</h2>
    <p>
        <span class="info"><?php print ($l->t('uPnP is a protocol that allows devices in your local network to ask your router to forward a public port to them. If your router have a public IPv4 and supports uPnP, you should be able to get your ownCloud publically avialable this way.')); ?></span>
    <h3 class="info">Local addresses</h3>
    <p id="ipv4addresses">
        <div id="ipv4-loading" class="icon-loading-small inlineblock"></div>
    </p>
    <h3>Routers address</h3>
    <p id="routerip">
        <div id="routerip-loading" class="icon-loading-small inlineblock"></div>
    </p>
</form>
