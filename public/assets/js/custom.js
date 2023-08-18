// Here goes your custom javascript
function IsNotNull(MyVar) {
    return (
        typeof MyVar == "undefined" ||
        MyVar == null ||
        MyVar == false ||
        MyVar == ""
    );
}

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function convertToRupiah(angka) {
    var rev = parseInt(angka, 10).toString().split("").reverse().join("");
    rev = !isNaN(rev) ? rev : 0;
    var rev2 = "";
    for (var i = 0; i < rev.length; i++) {
        rev2 += rev[i];
        if ((i + 1) % 3 === 0 && i !== rev.length - 1) {
            rev2 += ".";
        }
    }
    return "Rp. " + rev2.split("").reverse().join("") + ",00";
}

function convertToAngka(rp) {
    return parseInt(rp.replace(/,.*|\D/g, ""), 10);
}
