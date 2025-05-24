document.addEventListener('DOMContentLoaded', () => {
    const change_btns = document.querySelectorAll('.change');
    change_btns.forEach(btn => {
        btn.addEventListener('click', () => {
            const form = btn.closest('.category_box').querySelector('form');
            const computedStyle = window.getComputedStyle(form);
            const currentDisplay = computedStyle.display;
            if (currentDisplay === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }        })
    })
})
