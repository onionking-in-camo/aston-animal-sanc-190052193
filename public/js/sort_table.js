/**
 * Taken from https://stackoverflow.com/questions/3160277/jquery-table-sort
 * posted solution from rapttor, modified slightly to remove (some) of the
 * deprecated methods.
 */
$(function() {
    $('th.sortable').on('click', function(){
        var table = $(this).parents('table').eq(0);
        var ths = table.find('tr:gt(0)').toArray().sort(compare($(this).index()));
        this.asc = !this.asc;
        if (!this.asc)
           ths = ths.reverse();
        for (var i = 0; i < ths.length; i++)
           table.append(ths[i]);
    });
    
    function compare(idx) {
        return function(a, b) {
           var A = tableCell(a, idx), B = tableCell(b, idx)
           return $.isNumeric(A) && $.isNumeric(B) ? 
              A - B : A.toString().localeCompare(B)
        }
    }
    
    function tableCell(tr, index){ 
        return $(tr).children('td').eq(index).text() 
    }
});
