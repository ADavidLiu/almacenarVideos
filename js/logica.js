$(document).ready(function () {
    var video = $(":file#video");
    var nombreIn = $("input#nombre");
    var extensionIn = $("input#extension");
    var btnSubir = $("#btnSubir");
    var player = $("video");
    var btnMostrar = $("#btnMostrar");
    var nombreMostrarIn = $("input#nombreMostrar");
    var btnDescargar = $("#btnDescargar");
    var nombreDescargar = $("#nombreDescargar");

    btnSubir.click(function () {
        var file = video.get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                $.post("php/almacenarArchivo.php", {
                    archivo: e.target.result,
                    nombre: nombreIn.val(),
                    extension: extensionIn.val()
                }, function (sql) {
                    alert("Cargado con éxito");
                    nombreIn.val("");
                    extensionIn.val("");
                });
            };
        }
    });

    btnMostrar.click(function () {
        $.post("php/mostrarVideo.php", {
            nombre: nombreMostrarIn.val()
        }, function (archivo) {
            alert("Por favor espere unos segundos...");
            nombreMostrarIn.val("");
            player.attr("src", archivo);
            player.load();
            player.get(0).play();
        });
    });

    btnDescargar.click(function () {
        $.post("php/crearArchivo.php", {
            nombre: nombreDescargar.val()
        }, function () {
            alert("Descargado");
            nombreDescargar.val("");
        });
    });
});