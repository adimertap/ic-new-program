$(document).ready(function () {
    // "use strict";

    $("#datatable").DataTable();

    $("#datatable1").DataTable({
        ordering: true,
        paging: true,
    });

    $(".datatable-sertifikat").DataTable({
        // order: [[2, "asc"]],
        rowGroup: {
            dataSrc: 2,
        },
    });

    $("#datatable2").DataTable({
        scrollY: "300px",
        scrollCollapse: true,
        paging: false,
    });

    $("#datatable3").DataTable({
        scrollX: true,
        // responsive: false,
    });

    // $("#datatable4 tfoot th").each(function () {
    //     var title = $(this).text();
    //     $(this).html(
    //         '<input type="text" class="form-control" placeholder="Search ' +
    //             title +
    //             '" />'
    //     );
    // });

    // DataTable
    $("#datatable4").DataTable({
        responsive: true,
        rowGroup: {
            dataSrc: 3,
        },
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;

                    $("input", this.footer()).on(
                        "keyup change clear",
                        function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        }
                    );
                });
        },
    });
});
