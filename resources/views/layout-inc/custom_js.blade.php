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



    {{--   File uploader start   --}}
    // Buttons inside zoom modal
    const previewZoomButtonClasses = {
        rotate: 'btn btn-light btn-icon btn-sm',
        toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
        fullscreen: 'btn btn-light btn-icon btn-sm',
        borderless: 'btn btn-light btn-icon btn-sm',
        close: 'btn btn-light btn-icon btn-sm'
    };

    // Icons inside zoom modal classes
    const previewZoomButtonIcons = {
        prev: document.dir == 'rtl' ? '<i class="icon-arrow-right8"></i>' : '<i class="icon-arrow-left8"></i>',
        next: document.dir == 'rtl' ? '<i class="icon-arrow-left8"></i>' : '<i class="icon-arrow-right8"></i>',
        rotate: '<i class="icon-rotate-cw3"></i>',
        toggleheader: '<i class="icon-sort"></i>',
        fullscreen: '<i class="icon-screen-full"></i>',
        borderless: '<i class="icon-enlarge3 "></i>',
        close: '<i class="icon-cross2"></i>'
    };

    // File actions
    const fileActionSettings = {
        zoomClass: '',
        zoomIcon: '<i class="icon-zoomin3"></i>',
        dragClass: 'p-2',
        dragIcon: '<i class="icon-grid2"></i>',
        removeClass: '',
        removeErrorClass: 'text-danger',
        removeIcon: '<i class="icon-bin"></i>',
        indicatorNew: '<i class="icon-file-plus text-success"></i>',
        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner3 spinner text-muted"></i>'
    };
    {{--   File uploader end   --}}

</script>