(function($) {
    'use strict';
    $(document).ready(function() {
        $('#buttonsave').click(function(e) {
            e.preventDefault();
            let vehicleEls = $('.vehicle');
            if (vehicleEls.length > 0) {
                let vehicleChecked = [];
                $.each(vehicleEls, function() {

                    if (this.checked) {
                        let val = $(this).val();
                        let cost = parseInt($(this).attr("data-cost"));
                        let elVal = {
                            value: val,
                            cost: cost,
                        };
                        vehicleChecked.push(elVal);
                    }

                });
                console.log(vehicleChecked);
                $.ajax({
                    url: yay_settings.YAY_ADMIN_AJAX,
                    type: "POST",
                    data: {
                        action: "save_settings",
                        params: {
                            vehicleData: vehicleChecked
                        }

                    },
                    beforeSend: function() {},
                    success: function(result) {
                        if (result.success) {
                            alert(result.data.mess);
                        }
                    }
                });

            }
        })
    });
})(jQuery);