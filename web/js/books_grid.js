/**
 * Created by cejixo3 on 10.12.15.
 */

function nano(template, data) {
    return template.replace(/\{([\w\.]*)\}/g, function (str, key) {
        var keys = key.split("."), v = data[keys.shift()];
        for (var i = 0, l = keys.length; i < l; i++) v = v[keys[i]];
        return (typeof v !== "undefined" && v !== null) ? v : "";
    });
}

var someEvents = {};

$(document).ready(function () {

    $('.input-daterange').each(function () {
        $(this).datepicker({
            format:'M d, yyyy'
        });
    });

    $('[data-type="grid-image-preview"]').fancybox({
        closeBtn: false,
        openEffect: 'elastic'
    });

    function _rowPreview() {
        var o = {
            modalTemplateId: 'book-grid-modal-tpl',
            modalId: 'book-grid-modal'
        };

        $('body').on('hidden.bs.modal', '#' + o.modalId, function () {
            $(this).remove();
        });

        return {
            /**
             * @param url
             */
            getData: function (url) {
                $.ajax({
                    method: 'GET',
                    url: url,
                    dataType: "json",
                    success: function (data) {
                        $(someEvents).trigger('grid.data.received', [data]);
                    }
                });
            },
            /**
             * @param data
             */
            showModal: function (data) {
                var tpl = nano($('body #' + o.modalTemplateId).text(), data);
                $('body').append($(tpl));
                $('body #' + o.modalId).modal({
                    backdrop: 'static',
                    keyboard: true
                });
            }
        }
    }

    var rowPreview = _rowPreview();

    $(someEvents).on('grid.data.received', function (event, data) {
        rowPreview.showModal(data);
    });

    $('body').on('click', '[data-toggle="book-preview"]', function (event) {
        event.preventDefault();
        rowPreview.getData($(this).attr('href'));
    })

});