$(() => {
    $('.change').on('click', function () {
        $(this).parent().next('form').toggle();
    })
    $('.create').on('click', () => {
        $('.create_category').toggle();
    })
})
