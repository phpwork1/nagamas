jQuery(document).ready(function () {
    var sb = new StringBuilder();
    var baseUrl = $('#baseUrl').val();


    $('.historySellerModal').on('shown.bs.modal', function () {
        var sellerId = $(this).data('id');
        var date = $(this).data('date');
        $.ajax({
            url: baseUrl + '/purchase/ajax-seller-by-date',
            dataType: "json",
            type: 'post',
            data: {sellerId: sellerId, date: date},
            success: function(data) {
                if (data !== false) {
                    for(var i = 0; i<5; i++){
                        var tableData = data[i];
                        if(typeof tableData !== 'undefined'){
                            var table = $('.table-item-' + i);
                            table.removeClass('hide');
                            $('.loading-spinner-'+ i).hide();
                            var firstRow = table.find('tr:first');
                            sb.append('<th class="text-center removed" colspan="2">'+ tableData['date']+'</th>');
                            firstRow.append(sb.toString());
                            sb.clear();
                            var tableBody = table.find('tbody:first');
                            var bodyRow = tableBody.find('tr:first');
                            $.each(tableData['detail'], function(i, obj){
                                sb.append('<tr class="removed">');
                                sb.append('<td class="text-center">'+obj['name']+'</td>');
                                sb.append('<td class="text-center">'+obj['weight'].toLocaleString('id-ID')+'</td>');
                                sb.append('<td class="text-center">Rp. '+obj['price'].toLocaleString('id-ID')+'</td>');
                                sb.append('<td class="text-center">Rp. '+obj['total'].toLocaleString('id-ID')+'</td>');
                                sb.append('</tr>');
                                tableBody.prepend(sb.toString());
                                sb.clear();
                            });
                            sb.append('<td class="text-center yellow removed">'+ tableData['totalWeight'].toLocaleString('id-ID')+'</td>');
                            sb.append('<td class="removed"></td>');
                            sb.append('<td class="text-center yellow removed">Rp. '+tableData['totalDirty'].toLocaleString('id-ID')+'</td>');
                            bodyRow.append(sb.toString());
                            sb.clear();
                            bodyRow = bodyRow.next();

                            sb.append('<td class="text-center removed">Rp. '+tableData['commission'].toLocaleString('id-ID')+'</td>');
                            bodyRow.append(sb.toString());
                            sb.clear();
                            bodyRow = bodyRow.next();

                            sb.append('<td class="text-center removed">Rp. '+tableData['labor'].toLocaleString('id-ID')+'</td>');
                            bodyRow.append(sb.toString());
                            sb.clear();
                            bodyRow = bodyRow.next();

                            sb.append('<td class="text-center removed">Rp. '+tableData['stamp'].toLocaleString('id-ID')+'</td>');
                            bodyRow.append(sb.toString());
                            sb.clear();
                            bodyRow = bodyRow.next();

                            sb.append('<td class="text-center removed">Rp. '+tableData['other'].toLocaleString('id-ID')+'</td>');
                            bodyRow.append(sb.toString());
                            sb.clear();
                            bodyRow = bodyRow.next();

                            sb.append('<td class="text-center removed">Rp. '+tableData['totalClean'].toLocaleString('id-ID')+'</td>');
                            bodyRow.append(sb.toString());
                            sb.clear();
                            bodyRow = bodyRow.next();

                            table.hide().fadeIn(200);

                        }else{
                            $('.loading-spinner-'+ i).hide();
                        }
                    }
                } else {
                    alert('Fail');
                }
            }
        });
    }).on('hidden.bs.modal', function(){
        for(var i =0; i<5; i++) {
            var table = $('.table-item-' + i);
            table.addClass('hide');
            $('.loading-spinner-' + i).show();
        }
        $('.removed').remove();
    });

    $('.purchaseDetailModal').on('shown.bs.modal', function () {
        var purchaseId = $(this).data('id');
        $.ajax({
            url: baseUrl + '/purchase/ajax-purchase-detail',
            dataType: "json",
            type: 'post',
            data: {purchaseId: purchaseId},
            success: function(data) {
                if (data !== false) {
                    var table = $('.table-detail');
                    table.removeClass('hide');
                    var tableBody = table.find('tbody:first');
                    console.log(data);
                    $.each(data['detail'], function(i, obj){
                        sb.append('<tr class="removed">');
                        sb.append('<td class="text-center">'+obj['name']+'</td>');
                        sb.append('<td class="text-center">'+obj['weight'].toLocaleString('id-ID')+'</td>');
                        sb.append('<td class="text-center">Rp. '+obj['price'].toLocaleString('id-ID')+'</td>');
                        sb.append('<td class="text-center">Rp. '+obj['total'].toLocaleString('id-ID')+'</td>');
                        sb.append('</tr>');
                        tableBody.prepend(sb.toString());
                        sb.clear();
                    });

                    $('.loading-spinner').hide();
                    table.hide().fadeIn(200);
                } else {
                    alert('Fail');
                }
            }
        });
    }).on('hidden.bs.modal', function(){
        for(var i =0; i<5; i++) {
            var table = $('.table-detail');
            table.addClass('hide');
            $('.loading-spinner').show();
        }
        $('.removed').remove();
    });
});