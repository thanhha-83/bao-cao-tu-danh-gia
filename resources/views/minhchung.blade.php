<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="container">
    <label for="minhChung">Chọn minh chứng</label>
    <select class="form-control tags-select-only" name="minhChung" id="minhChung">
    </select>
    @csrf
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            method: 'POST',
            url: "/minhchung/getall",
            data: { _token: $('input[name="_token"]').val() },
            success: (data) => {
                data.forEach((item) => {
                    $('#minhChung').append(`<option value="${item.link}">${item.ten}</option>`)
                })
            },
        })
        $('.tags-select-only').select2({
            width: '100%'
        });
    });
    window.addEventListener('message', function(event) {
        if (event.data.mceAction === 'customInsertAndClose') {
            var value = {
                href: $('#minhChung').val(),
                title: $('.select2-selection__rendered').text()
            };

            window.parent.postMessage({
                mceAction: 'execCommand',
                cmd: 'iframeCommand',
                value
            }, origin);

            window.parent.postMessage({
                mceAction: 'close'
            }, origin);
        }
    });
</script>
