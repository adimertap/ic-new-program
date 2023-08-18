window.onscroll = () => {
    const header = document.querySelector("header");
    const imageLeft = document.querySelector("#imageLeft");
    const imageRight = document.querySelector("#imageRight");
    const showNav = header.offsetTop;

    if (window.pageYOffset > showNav) {
        header.classList.add("navbar-fixed");
    } else {
        header.classList.remove("navbar-fixed");
    }

    if (window.pageYOffset >= 600) {
        imageLeft.classList.add("animate-fadeIn");
    }

    if (window.pageYOffset >= 1000) {
        imageRight.classList.add("animate-fadeIn");
    }
};
