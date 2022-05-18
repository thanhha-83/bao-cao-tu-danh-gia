$(document).ready(function () {
    var dialogConfig = {
        title: "Dialog Demo",
        url: "iframe",
        buttons: [
            {
                type: "custom",
                name: "insert-and-close",
                text: "Insert and Close",
                primary: true,
                align: "end",
            },
            {
                type: "cancel",
                name: "cancel",
                text: "Close Dialog",
            },
        ],
        width: 600,
        height: 300,
        onAction: function (instance, trigger) {
            instance.sendMessage({
                mceAction: "customInsertAndClose",
            });
        },
    };
    tinymce.init({
        selector: "textarea.tiny-editor",
        relative_urls: false,
        content_css: "../../css/tiny-editor.css",
        plugins:
            "advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template",
        toolbar:
            "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image minhchung",
        link_default_target: "_blank",
        link_list: [
            { title: "Tiny Home Page", value: "https://www.tiny.cloud" },
            { title: "Tiny Blog", value: "https://www.tiny.cloud/blog" },
            {
                title: "TinyMCE Documentation",
                value: "https://www.tiny.cloud/docs/",
            },
            {
                title: "TinyMCE on Stack Overflow",
                value: "https://stackoverflow.com/questions/tagged/tinymce",
            },
            { title: "TinyMCE GitHub", value: "https://github.com/tinymce/" },
        ],
        link_class_list: [
            { title: "Là minh chứng", value: "is-minhchung" },
            { title: "Link bình thường", value: "" },
        ],
        file_picker_callback: function (callback, value, meta) {
            let x =
                window.innerWidth ||
                document.documentElement.clientWidth ||
                document.getElementsByTagName("body")[0].clientWidth;
            let y =
                window.innerHeight ||
                document.documentElement.clientHeight ||
                document.getElementsByTagName("body")[0].clientHeight;
            let type = "image" === meta.filetype ? "Images" : "Files",
                url = "/laravel-filemanager?editor=tinymce5&type=" + type;
            tinymce.activeEditor.windowManager.openUrl({
                url: url,
                title: "Filemanager",
                width: x * 0.8,
                height: y * 0.8,
                onMessage: (api, message) => {
                    callback(message.content);
                },
            });
        },
        setup: function (editor) {
            editor.ui.registry.addButton("minhchung", {
                text: "Minh chứng",
                onAction: () => {
                    _api = editor.windowManager.openUrl(dialogConfig);
                },
            });

            editor.addCommand("iframeCommand", function (ui, value) {
                editor.insertContent(
                    `<a href="${value.href}" class="is-minhchung">${value.title}</a>`
                );
            });
        },
    });
});
