$(document).ready(function() {
    new Vue({
        el: ".app-chat-realtime",
        data() {
        return {
            id: {{ auth()->id() }},
            message: "",
            users: [],
            messages: [],
        }
        },
    })
})
