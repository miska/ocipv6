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
<form id="ocipv6dynv6" class="section">
    <h2>Dynv6</h2>
    <p>
		<span class="info"><a href="http://dynv6.com">Dynv6</a> is one of the dynamic dns services that can assign your cloud nice domain name that will get updated with your IP (including IPv6) everytime it changes.</span>
    </p>
    <p>
        <div id="dynv6-loading" class="icon-loading-small inlineblock"></div>
		<label for="Dynv6Hostname">Hostname</label>
		<input type="text" name="dynv6_hostname" id="Dynv6Hostname"/>
		<label for="Dynv6Token">Token</label>
		<input type="text" name="dynv6_token" id="Dynv6Token"/>
		<input type="button" name="dynv6_save" id="Dynv6Save" value="Save"/>
    </p>
</form>
