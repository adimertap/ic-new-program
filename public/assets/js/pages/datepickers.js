$(document).ready(function () {
    "use strict";
    $(".flatpickr1").flatpickr();

    $(".flatpickr2").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });

    $(".timepickr").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });
});
