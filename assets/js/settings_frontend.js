(function($) {
    'use strict';
    $(document).ready(function() {
        var total = Number(document.getElementById("total").getAttribute('data-cost'));
        console.log(total);
        $(".vehicle").click(function() {
            if ($(this).prop("checked") == true) {
                var data_cost = Number(this.getAttribute('data-cost'));
                total += data_cost;
                document.getElementById("total_last").innerHTML = total;
            } else {
                var data_cost = Number(this.getAttribute('data-cost'));
                total -= data_cost;
                document.getElementById("total_last").innerHTML = total;
            }
        });
    });
})(jQuery);