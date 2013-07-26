YUI().use('node', function (Y) {

    var buttons = Y.all('.reject-button');
    buttons.each(function (e) {
        data = e._node.parentElement.id.split('_');
        Y.one('#reject_form_id_' + data[1]).hide();
        Y.one('#accept_form_id_' + data[1]).hide();
    });

    Y.all('.reject-button').on('click', function (e) {
        data = e._currentTarget.parentElement.id.split('_');
        Y.one('#reject_form_id_' + data[1]).show();
        Y.one('#' + e._currentTarget.parentElement.id).hide();
    });
    Y.all('.accept-button').on('click', function (e) {
        data = e._currentTarget.parentElement.id.split('_');
        Y.one('#accept_form_id_' + data[1]).show();
        Y.one('#' + e._currentTarget.parentElement.id).hide();
    });

});

