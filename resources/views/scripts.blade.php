<script>
    $(function() {
        $('.form-check-input').click(function() {
            $('.btn-download').prop(
                'disabled',
                $('input.form-check-input:checked').length == 0
            );
        });

        $('#countryDropdown').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('.dropdown-menu li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });

    $(document).ready(function() {
        $('#accessBtn').click(function() {
            var userId = $(this).data('user-id');
            $.ajax({
                url: '/users/' + userId + '/access-email',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#email').html(response.email);
                    $('#credits').html(response.credits);
                },
                error: function(xhr) {
                    alert(xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function() {
        setInterval(function() {
            $.ajax({
                url: '{{ route('get.credits') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#credits').text(response.credits);
                }
            });
        }, 5000);
    });

    $(document).ready(function() {
        $('#download').click(function() {
            var selectedItems = $('input[name="selected_items[]"]:checked').map(function() {
                return $(this).val();
            }).get();
            if (selectedItems.length > 0) {
                var url = $(this).data('url');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'selected_items': selectedItems
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.statusText + ': ' + xhr.responseText);
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('#apply-name').click(function() {
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, textStatus, error) {
                    console.log(xhr.statusText + ': ' + xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#apply-job').click(function() {
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, textStatus, error) {
                    console.log(xhr.statusText + ': ' + xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#apply-company').click(function() {
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, textStatus, error) {
                    console.log(xhr.statusText + ': ' + xhr.responseText);
                }
            });
        });
    });
</script>
