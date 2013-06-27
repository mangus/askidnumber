YUI().use('node', function (Y) {

    var buttons = Y.all('.yui-button');
    buttons.each(function (e) {
        data = e._node.parentElement.id.split('_');
        Y.one('#reject_form_id_' + data[1]).hide();
    });

    Y.all('.yui-button').on('click', function (e) {
        data = e._currentTarget.parentElement.id.split('_');
        Y.one('#reject_form_id_' + data[1]).show();
        Y.one('#' + e._currentTarget.parentElement.id).hide();
    });

});

