function refresh_ipv6() {
    var baseUrl = OC.generateUrl('/apps/ipv6');
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
    var baseUrl = OC.generateUrl('/apps/ipv6');
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
    var baseUrl = OC.generateUrl('/apps/ipv6');
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
});
