document.addEventListener('DOMContentLoaded', function() {
	
    // open js tab
    var hash = window.location.hash;
        if(hash != '') {
          $('.nav-tabs a[href="' + hash + '"]').tab('show');
    }

    // popover
    $('.pop-admin').popover({
        trigger: 'hover',
        content: 'Contact admin to update.'
    });

    $('[data-toggle="popover"]').popover({
        trigger: 'hover'
    });

    // Remove card   
    $('.card [data-action=back]').on('click', function (e) {
        e.preventDefault();
        var $target = $(this),
            slidingSpeed = 150;

        // If not disabled
        if(!$target.hasClass('disabled')) {
            javascript:history.back();
        }
    });

    // Data Table
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span class="me-3">Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
        }
    });

    // initialise datatable
    $('.datatable').DataTable();



});

