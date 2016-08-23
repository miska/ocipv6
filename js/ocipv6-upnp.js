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

function set_upnp(ip_val) {
    var baseUrl = OC.generateUrl('/apps/ocipv6');
    var my_post = { ip: ip_val };
    $('#ipv4-loading').show();
    $('#ipv4addresses').html('');
    $('#routerip-loading').show();
    $('#routerip').html('');
    $.ajax({
        url: baseUrl + '/upnp',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(my_post)
    }).done(function (response) {
        refresh_upnp();
    });
}

function refresh_upnp() {
    var baseUrl = OC.generateUrl('/apps/ocipv6');
    $('#ipv4-loading').show();
    $('#ipv4addresses').html('');
    $('#routerip-loading').show();
    $('#routerip').html('');
    $.ajax({
        url: baseUrl + '/upnp',
        type: 'GET',
        contentType: 'application/json',
    }).done(function (response) {
        var text = '';
        if(response.ext_ip.length > 0) {
            text = 'Your routers address is <span class="ip-address">' + response.ext_ip + '</span>. ';
            if(response.dest_ip.length > 0) {
                text += 'It is forwarded to <class="ip-address">' + response.dest_ip + '</span>';
                if((response.dest_port.length > 0) && (response.dest_port != '443')) {
                    text += ' and port <class="ip-address">' + response.dest_port + '</span>';
                }
                var pub_url = 'https://' + response.ext_ip;
                if(response.dest_port != '443') {
                    pub_url += ':' + response.dest_port + '/';
                }
                text += '. Thus this url should work: <a href="' + pub_url + '/">' + pub_url + '</a> .';
                if('443' != response.dest_port) {
                    text += '<br/>WARNING: You are forwarding port ' + response.dest_port + ' to your cloud.';
                    text += " This is not a standard https port. Probably your router can't forward https one.";
                    text += ' Make sure that your cloud is listening on this port as well.';
                }
                if(location.port != response.dest_port) {
                    text += '<br/>WARNING: You are accessing your cloud on port differing from forwarding destination.';
                }
            } else {
                text += 'It is not forwarded to anywhere.';
            }
            $('#routerip').html(text);
        } else {
            $('#routerip').html("Can't detect router IP, do you have uPnP enabled?");
        }
        $('#routerip-loading').hide();
        text = '';
        if(response.ipv4.length > 0) {
            text = '<ul class="ip-address">\n';
            response.ipv4.forEach(function(callback, arg) {
                text += '<li><a href="'
                     + document.location.protocol
                     + '//' + response.ipv4[arg] + ''
                     + '/">' 
                     + response.ipv4[arg]
                     + '</a> '
                     + '<a href="#" class="upnp_setter" data-ip="'
                     + ((response.ipv4[arg] !=  response.dest_ip) ? response.ipv4[arg] : '')
                     + '">'
                     + ((response.ipv4[arg] !=  response.dest_ip) ? 'Forward here' : 'Stop forwarding')
                     + '</a> ' + '</li>' + '\n';
            });
            text+= '</ul>';
        } else {
            text = '<p>No IPv4 adressses found.</p>';
        }
        $('#ipv4-loading').hide();
        $('#ipv4addresses').html(text);
    });
}

$(document).ready(function() {
    refresh_upnp();
    $('#ipv4addresses').on('click', '.upnp_setter', function() {
        set_upnp($(this).data("ip"));
    });
});
