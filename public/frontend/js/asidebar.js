const hamburgerBtn = document.getElementById('hamburgerBtn');
const offcanvas = new bootstrap.Offcanvas('#offcanvasNavbar');
hamburgerBtn.addEventListener('click', () => {
    offcanvas.toggle();
});