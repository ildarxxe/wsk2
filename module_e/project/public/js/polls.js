document.addEventListener('DOMContentLoaded', () => {
    const showShortLinksBtn = document.querySelector('.showShortLinksBtn');
    showShortLinksBtn.addEventListener('click', () => {
        const ul = showShortLinksBtn.closest('.polls').querySelector('.short_links');
        const computedStyle = window.getComputedStyle(ul)
        const currentDisplay = computedStyle.display;

        if (currentDisplay === "none") {
            ul.style.display = 'block'
        } else {
            ul.style.display = 'none'
        }
    })
})
