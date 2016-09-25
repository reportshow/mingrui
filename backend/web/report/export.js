$(document).ready(function () {
// built around .exportable class, add this to any <table> element in order to make it exportable to csv
    function exportTableToCSV($table, filename) {
        var $rows = $table.find('tr:has(td)');

        // psuedo delimiters to avoid awkward string splitting, feel free to change these
        var tmpColDelim = String.fromCharCode(11); // vertical tab character
        var tmpRowDelim = String.fromCharCode(0);// null character

        // chosen delimiters
        var colDelim = '","';
        var rowDelim = '"\r\n"';

	var csv = '"基因（大小）","突变信息","突变类型","基因疾病信息","HET","HGMD","功能预测"\r\n';
        // Get table contents
        csv = csv+ '"' + $rows.map(function (i, row) {
            var $row = $(row);
            var $cols = $row.find('td');
            return $cols.map(function (j, col) {
                var $col = $(col);
                var text = $col.text();
		
                return text.replace(/"/g, '""'); // escape double quotes

            }).get().join(tmpColDelim);

        }).get().join(tmpRowDelim)
            .split(tmpRowDelim).join(rowDelim)
            .split(tmpColDelim).join(colDelim) + '"';

        // Data URI
        csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

        $(this)
            .attr({
		'download': filename,
                'href': csvData,
                'target': '_blank'
            });
    }

    // function exportTableToCSVCompatible($table, filename) {

    //     var $rows = $table.find('tr:has(td)'),

    //         // psuedo delimiters to avoid string splitting
    //         tmpColDelim = String.fromCharCode(11), // vertical tab character
    //         tmpRowDelim = String.fromCharCode(0), // null character

    //         // chosen delimiters
    //         colDelim = '","',
    //         rowDelim = '"\r\n"',

    //         // Get table contents
    //         csv = '"' + $rows.map(function (i, row) {
    //             var $row = $(row),
    //                 $cols = $row.find('td');

    //             return $cols.map(function (j, col) {
    //                 var $col = $(col),
    //                     text = $col.text();

    //                 return text.replace(/"/g, '""'); // escape double quotes

    //             }).get().join(tmpColDelim);

    //         }).get().join(tmpRowDelim)
    //             .split(tmpRowDelim).join(rowDelim)
    //             .split(tmpColDelim).join(colDelim) + '"',

    //         // Data URI
    //         csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    //         $.ajax({
    //             url:'export.php',
    //             data:{csv: csv},
    //             type: 'POST'})
    //             .done(function() {
    //                 location.reload();
    //             })
    //             .fail(function() {
    //                 alert("Unable to export the data. Please try again.");
    //             });
    //         });

    //     /*$(this)
    //         .attr({
    //         'download': filename,
    //             'href': csvData,
    //             'target': '_blank'
    //     }); */
    // }
    function exportTableToCSVCompatible($table, filename) {

    }
    // Duck typing for IE which calls alternative method if necessary
    $(".export_button").on('click', function (event) {
        // CSV
        // var isIE = /*@cc_on!@*/false || !!document.documentMode;   // At least IE6
        // if(isIE == true) {
        //     exportTableToCSVCompatible.apply(this, [$(this).next('.exportable'), 'export.csv']); 
        // } else {
        exportTableToCSV.apply(this, [$('.exportable'), '基因检测诊断过滤结果.csv']);
        // }
    });
});
