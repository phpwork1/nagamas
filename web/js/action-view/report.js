$(document).ready( function () {
    $('#month-select').change(function(){
        this.form.submit();
    })

    $('#year-select').change(function(){
        this.form.submit();
    });
} );