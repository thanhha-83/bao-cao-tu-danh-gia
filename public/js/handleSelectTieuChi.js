$('#tieuChi_id').on('change', () => {
    const stt = $('#tieuChi_id').find('option:selected').data('stt');
    console.log(stt);
    if (stt == 0) {
        $('.is-normal-tieuchi').toggleClass('d-none');
        $('.is-tieuchi-0').toggleClass('d-none');
    } else {
        $('.is-normal-tieuchi').toggleClass('d-none');
        $('.is-tieuchi-0').toggleClass('d-none');
    }
})
