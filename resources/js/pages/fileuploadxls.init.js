import select2 from 'select2';
select2(window, jQuery);

import moment from "moment"
window.moment = moment;
import 'daterangepicker/moment.min.js';
import 'daterangepicker/daterangepicker.js';

import Dropzone from 'dropzone';
import $ from 'jquery'; // Asegúrate de tener jQuery disponible

!function ($) {
    "use strict";

    var FileUpload = function () {
        this.$body = $("body")
    };

    /* Initializing */
    FileUpload.prototype.init = function () {
        // Disable auto discovery
        Dropzone.autoDiscover = false;

        $('[data-plugin="dropzone"]').each(function () {
            var actionUrl = $(this).attr('action');
            var previewContainer = $(this).data('previewsContainer');

            var opts = {
                url: actionUrl,
                autoProcessQueue: false, // Desactivar el procesamiento automático
                acceptedFiles: ".xls,.xlsx", // Especificar los tipos de archivos aceptados
            };

            if (previewContainer) {
                opts['previewsContainer'] = previewContainer;
            }

            var uploadPreviewTemplate = $(this).data("uploadPreviewTemplate");
            if (uploadPreviewTemplate) {
                opts['previewTemplate'] = $(uploadPreviewTemplate).html();
            }

            var myDropzone = new Dropzone(this, opts); // Inicialización manual de Dropzone con las opciones definidas

            // Encuentra el botón de envío en el formulario y escucha el evento de clic
            $(this).find("#submitPayment").on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue(); // Procesa la cola cuando se hace clic en el botón
            });

            // Muestra el spinner de barra de progreso cuando se envía el archivo
            myDropzone.on("sending", function(file, xhr, formData) {
                $('#spinnerOverlay').show(); // Muestra el spinner cuando se envía el archivo
            });

            // Cuando la carga del archivo se completa (exitosa o no)
            myDropzone.on("complete", function(file) {
                $('#spinnerOverlay').hide(); // Oculta el spinner después de la carga del archivo
                myDropzone.removeFile(file); // Opcional: remover archivos después de la carga
            });

            myDropzone.on("success", function(file, response) {
                // Muestra SweetAlert2 si la carga es exitosa
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Carga exitosa',
                        text: response.message || 'El archivo se ha cargado correctamente.'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Ha ocurrido un error al insertar datos del archivo.'
                    });
                }
            });

            myDropzone.on("error", function(file, response) {
                // Muestra SweetAlert2 si hay un error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ha ocurrido un error al cargar el archivo.'
                });
            });
        });
    },

        // init FileUpload
        $.FileUpload = new FileUpload, $.FileUpload.Constructor = FileUpload

}(window.jQuery),

// Initializing FileUpload
    function ($) {
        "use strict";
        $.FileUpload.init()
    }(window.jQuery);
