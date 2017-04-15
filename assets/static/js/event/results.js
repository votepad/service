$(document).ready(function() {


    /** Printing Formula on existed stages */
    $('.formula-print').each(function () {

        formula.create(document.getElementById(this.id), {
            mode: "print",
            allItems: document.getElementById('allContests').dataset.items,
            curItems: this.dataset.items
        });

    });

    /** Formula on creating new stage */
    var resultFormula = formula.create(document.getElementById('result_formula'), {
        mode: "create",
        allItems: document.getElementById('allContests').dataset.items
    });


    /** save formula */
    $('#saveResult').click(function () {
        if ( $("#result_formula .formula__list li").length == 0 ) {
            $.notify({ message: "Формула не изменилась.<br>Для изменение создайте формулу."},{ type: 'warning'});
            $('#saveResult').addClass('hide');
            $('#editResult').removeClass('hide');
            $('#result_formula').parent().addClass('hide');
            $('.formula-print').parent().removeClass('hide');
        } else {
            $('#result').submit();
        }
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
        if ( $("#result_formula .formula__list li").length == 0 ) {
            $.notify({ message: "Пожалуйста, введите формулу."},{ type: 'danger'});
            $('#result_formula').addClass('formula--error');
            return false;
        } else {
            $('#result_formula').value = resultFormula.toJSON();
            $('#result_formula').removeClass('formula--error');
        }
    });

});
