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
    var baseUrl = OC.generateUrl('/apps/ocipv6');
    $.ajax({
        url: baseUrl + '/dynv6',
        type: 'GET',
        contentType: 'application/json',
    }).done(function (response) {
		$('#Dynv6Hostname').val(response.hostname);
		$('#Dynv6Token').val(response.token);
    });
}

function save_dynv6() {
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
    });
}

function refresh_ipv6() {
    var baseUrl = OC.generateUrl('/apps/ocipv6');
    $.ajax({
        url: baseUrl + '/ipv6',
        type: 'GET',
        contentType: 'application/json',
    }).done(function (response) {
        if(response.ipv6.length > 0) {
            var text = '<ul class="ip-address">\n';
            response.ipv6.forEach(function(callback, arg) {
                text += '<li><a href="'
                     + document.location.protocol
                     + '//[' + response.ipv6[arg] + ']'
                     + '/">' 
                     + response.ipv6[arg]
                     + '</a></li>' + '\n';
            });
            text+= '</ul>';
        } else {
            text = '<p>No IPv6 adressses found.</p>';
        }
        $('#ipv6addresses').html(text);
    });
}

function update_teredo(val) {
    var baseUrl = OC.generateUrl('/apps/ocipv6');
    $('#TeredoEnable').prop("disabled", true);
    if(val) {
        $.ajax({
            url: baseUrl + '/enable_teredo',
            type: 'POST',
            contentType: 'application/json',
        }).done(function (response) {
            $('#TeredoEnable').prop("checked", response.enabled);
            $('#TeredoEnable').prop("disabled", false);
            refresh_ipv6();
        });
    } else {
        $.ajax({
            url: baseUrl + '/disable_teredo',
            type: 'POST',
            contentType: 'application/json',
        }).done(function (response) {
            $('#TeredoEnable').prop("checked", response.enabled);
            $('#TeredoEnable').prop("disabled", false);
            refresh_ipv6();
        });
    }
}

function check_teredo() {
    var baseUrl = OC.generateUrl('/apps/ocipv6');
    $('#TeredoEnable').prop("disabled", true);
    $.ajax({
        url: baseUrl + '/teredo',
        type: 'GET',
        contentType: 'application/json',
    }).done(function (response) {
        $('#TeredoEnable').prop("checked", response.enabled);
        $('#TeredoEnable').prop("disabled", false);
    });
}

$(document).ready(function() {
    refresh_ipv6();
    check_teredo();
    $('#TeredoEnable').on('change', function() {
        update_teredo($(this).prop("checked"));
    });
    refresh_dynv6();
    $('#Dynv6Save').click(function() { save_dynv6(); });
});
