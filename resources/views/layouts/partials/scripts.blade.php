<script>
    $(document).ready(function() {
        $('.counter-btn').on('click', function() {
            var input = $(this).siblings('.counter-input');
            var value = parseInt(input.val());
            if ($(this).hasClass('increment')) {
                value++;
            } else if ($(this).hasClass('decrement') && value > 1) {
                value--;
            }
            input.val(value);
            if($(this).hasClass('decrease-c')){
                $('#post-type').val('decrease')
            }
            if($(this).hasClass('increase-c')){
                $('#post-type').val('increase')
            }

        });
    });
</script>
