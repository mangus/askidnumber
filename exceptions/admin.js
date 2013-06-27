YUI().use('node', function (Y) {

    Y.all('.mform').hide();

    Y.all('.yui-button').on('click', function (e) {
        data = e._currentTarget.parentElement.id.split('_');
        console.log('#reject_form_id_' + data[1]);
        Y.one('#reject_form_id_' + data[1]).show();
    });

});

