$(document).ready(function() {
    $('.tags-select').select2({
        insertTag: function (data, tag) {
            data.push(tag);
        },
        tags: true,
        tokenSeparators: [','],
        width: '100%'
    });
});
