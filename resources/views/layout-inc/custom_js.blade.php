<script>

    {{-- Notifications --}}
    @if (session('flash_success'))
        new Noty({
            text: '{{session('flash_success')}}',
            type: 'success',
            theme: 'limitless',
            timeout: 2500
        }).show();
    @endif

    @if (session('flash_error'))
        new Noty({
            text: '{{session('flash_error')}}',
            type: 'error',
            theme: 'limitless',
            timeout: 2500
        }).show();
    @endif

    @if (session('flash_warning'))
        new Noty({
            text: '{{session('flash_warning')}}',
            type: 'warning',
            theme: 'limitless',
            timeout: 2500
        }).show();
    @endif

    {{-- Confirm deletion --}}
    function confirmDelete(id) {
        var notyConfirm = new Noty({
            text: '<h6 class="text-primary my-3">Please confirm your action</h6><p> Content will remove permanently.</p><p> Are you sure? </p>',
            timeout: false,
            modal: true,
            layout: 'center',
            closeWith: 'button',
            type: 'confirm',
            buttons: [
                Noty.button('Cancel', 'btn btn-link', function () {
                    notyConfirm.close();
                }),

                Noty.button('Ok', 'btn btn-sm btn-outline-danger ms-1', function () {
                        // submit form
                        $('form#item-delete-'+id).submit();
                        notyConfirm.close();
                    }
                )
            ]
        }).show();
    }
    

</script>