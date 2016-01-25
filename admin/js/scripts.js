
$(document).ready(
    function() {
        $('#checkAll').click(function(event) {
            if (this.checked) {
                $('.bulk-checkbox').each(function() {
                    this.checked = true;
                });
            }
            else {
                $('.bulk-checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
        
        $('.bulk-checkbox').click(function(event) {
            var allChecked = true;
            $('.bulk-checkbox').each(function() {
                if (!this.checked) allChecked = false;
            });
            $('#checkAll')[0].checked = allChecked;
        });
    }
);