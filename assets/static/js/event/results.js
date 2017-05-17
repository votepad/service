$(document).ready(function() {


    /** Printing Formula on existed stages */
    formula.create(document.getElementById('result_formula_print'), {
        mode: "print",
        curItems: document.getElementById('result_formula_print').dataset.items
    });

    /** Formula on editing new stage */
    var resultFormula = formula.create(document.getElementById('result_formula'), {
        mode: "edit",
        allItems: document.getElementById('allContests').dataset.items,
        curItems: document.getElementById('result_formula_print').dataset.items
    });

    /** open editing formula */
    $('#editResult').click(function () {
        $('#saveResult').removeClass('hide');
        $('#editResult').addClass('hide');
        $('#result_formula').parent().removeClass('hide');
        $('.formula-print').parent().addClass('hide');
    });


    /* Upadete formula */
    $('#result').submit(function () {
        if ( !resultFormula.toJSON() ) {
            vp.notification.notify({
                type: 'warning',
                message: 'Пожалуйста, введите формулу.',
                time: 3
            });
            $('#result_formula').addClass('formula--error');
            return false;
        }
    });

});
