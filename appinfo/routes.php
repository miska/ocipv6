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
<?php
return ['routes' => [
    ['name' => 'admin#GetIPv6', 'url' => '/ipv6', 'verb' => 'GET'],
    ['name' => 'admin#GetDynv6', 'url' => '/dynv6', 'verb' => 'GET'],
    ['name' => 'admin#SetDynv6', 'url' => '/dynv6', 'verb' => 'POST'],
    ['name' => 'admin#GetuPnP', 'url' => '/upnp', 'verb' => 'GET'],
    ['name' => 'admin#SetuPnP', 'url' => '/upnp', 'verb' => 'POST'],
    ['name' => 'admin#EnableTeredo', 'url' => '/enable_teredo', 'verb' => 'POST'],
    ['name' => 'admin#DisableTeredo', 'url' => '/disable_teredo', 'verb' => 'POST'],
    ['name' => 'admin#GetTeredo', 'url' => '/teredo', 'verb' => 'GET'],
]];
?>
