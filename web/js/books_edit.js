/**
 * Created by cejixo3 on 10.12.15.
 */
$(document)
    .ready(function () {



        $('[data-type="release_date_ui"]')

            .datepicker({
                format: {
                    toDisplay: function (date) {
                        return new Date(date).getTime() / 1000;
                    },
                    toValue: function (date) {
                        return new Date(date);
                    }
                },
                autoclose: true
            })

            .datepicker('update', $('[data-type="release_date_ui"]').data('dateUi'))

            .on("changeDate", function () {

                $('[data-type="release_date"]').val(
                    $(this).datepicker('getFormattedDate')
                );
            });


    });