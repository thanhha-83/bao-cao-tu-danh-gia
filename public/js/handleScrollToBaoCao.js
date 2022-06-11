$(".baocao-scrollItem").on("click", (e) => {
    e.preventDefault();
    const id = $(e.currentTarget).attr('href');
    const scrollTop = $(`${id}`).offset().top - 100;
    $("html, body").animate(
        {
            scrollTop: scrollTop,
        },
        200,
        'swing'
    );
    $(`#${id}`).addClass('is-focus');
    setTimeout(()=> {
        $(`#${id}`).removeClass('is-focus');
    }, 3000);
});
