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




});

