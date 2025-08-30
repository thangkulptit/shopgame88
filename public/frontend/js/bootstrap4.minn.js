function ajaxSetup() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function loading(status) {
    switch (status) {
        case 'show':
            $('.wrap-loading').css({ 'visibility': 'visible' });
            break;
        case 'hide':
            $('.wrap-loading').css({ 'visibility': 'hidden' });
            break;
        default:
            break;
    }
}

function loadingAccount(status) {
    switch (status) {
        case 'show':
            $('#loading').css({ 'display': 'block' });
            break;
        case 'hide':
             $('#loading').css({ 'display': 'none' });
            break;
        default:
            break;
    }
}