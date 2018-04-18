$(document).ready( function () {
    $(document).on('change', '.date', function(){
        var factory = $('#factory').val();
        var priceBam = $('#bam-b_price');
        var pricePal = $('#pal-p_price');
        var priceBamDisp = $('#bam-b_price-disp');
        var pricePalDisp = $('#pal-p_price-disp');
        var baseUrl = $('#baseUrl').val();

        if ($(this).val() !== '') {
            $.ajax({
                url: baseUrl + '/palm/latest-price',
                type: 'post',
                data: {date: $(this).val(), factory: factory},
                dataType: 'json',
                success: function (data) {
                    if (data !== false) {
                        if(factory === 'bam') {
                            priceBam.val(data['price']);
                            priceBamDisp.val(data['price']);
                        }else if (factory === 'pal') {
                            pricePal.val(data['price']);
                            pricePalDisp.val(data['price']);
                        }
                    } else {

                        if(factory === 'bam') {
                            priceBam.val(0);
                            priceBamDisp.val(0);
                        }else if (factory === 'pal') {
                            pricePal.val(0);
                            pricePalDisp.val(0);
                        }

                    }
                }
            });
        } else {
            alert('Pilihan salah.');
        }
    });


} );