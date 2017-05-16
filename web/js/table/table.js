$(document).on('ready pjax:complete',function(){


    $('.table input.check-box').click(function(event) {
        var keys = $('.grid-view').yiiGridView('getSelectedRows');
        var trList = $('.table tbody tr');

        trList.each(function (item) {
            var text = $(this).attr('data-key');

            if (keys.indexOf(text) != -1 ) {
                $(this).addClass('checked');
            } else if ($(this).hasClass('checked')) {
                $(this).removeClass('checked');
            }
        });
    });


    $('.table input.select-on-check-all').click(function(event) {


        var self = this;

        setTimeout(function () {
            var keys = $('.grid-view').yiiGridView('getSelectedRows');
            var trList =  $('.table tbody tr');

            trList.each(function (item) {
                var text = $(this).attr('data-key');

                if($(self).is(':checked') && keys.indexOf(text) != -1 ) {
                    $(this).addClass('checked');
                } else {
                    $(this).removeClass('checked');
                }
            });

        },10);
    });


});

var table = {
    dropSchemaList: function () {

        if(confirm('Are you sure?')){
            var keys = $('.grid-view').yiiGridView('getSelectedRows');
            $.ajax({
                type: 'POST',
                url: '/schema/delete',
                dataType: 'json',
                data: {selections: keys},
            });
        }
    },

    dropTableList: function () {

        if(confirm('Are you sure?')){
            var keys = $('.grid-view').yiiGridView('getSelectedRows');

            var url = location.pathname;

            var schema = url.split('/')[3];

            $.ajax({
                type: 'POST',
                url: '/table/delete/' + schema,
                dataType: 'json',
                data: {selections: keys},
            });
        }
    }

}
