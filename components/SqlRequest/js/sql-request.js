$(document).on('ready pjax:complete',function () {

    var textarea = $('textarea[name="query"]');
    textarea.css('visibility', 'hidden');


    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/github");
    editor.getSession().setMode("ace/mode/sql");
    editor.getSession().setValue(textarea.val());


    textarea.closest('form').submit(function() {
        textarea.val(editor.getSession().getValue());
    })

});

