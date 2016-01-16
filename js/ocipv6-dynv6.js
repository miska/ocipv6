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

function refresh_dynv6() {
    $('#dynv6-loading').show();
    var baseUrl = OC.generateUrl('/apps/ocipv6');
    $.ajax({
        url: baseUrl + '/dynv6',
        type: 'GET',
        contentType: 'application/json',
    }).done(function (response) {
		$('#Dynv6Hostname').val(response.hostname);
		$('#Dynv6Token').val(response.token);
        $('#dynv6-loading').hide();
    });
}

function save_dynv6() {
    $('#dynv6-loading').show();
    var baseUrl = OC.generateUrl('/apps/ocipv6');
    var my_post = { hostname: $('#Dynv6Hostname').val(),
                    token: $('#Dynv6Token').val() };
    $.ajax({
        url: baseUrl + '/dynv6',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(my_post)
    }).done(function (response) {
		$('#Dynv6Hostname').val(response.hostname);
		$('#Dynv6Token').val(response.token);
        $('#dynv6-loading').hide();
    });
}

$(document).ready(function() {
    refresh_dynv6();
    $('#Dynv6Save').click(function() { save_dynv6(); });
});
