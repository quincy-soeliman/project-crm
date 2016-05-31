function analyseDropdown($targetToOpen) {

    // Triggers for analyse box dropdown
    // Do triggers for each analyse box sepparetly
    $(".trigger-dropdown").each( function() {
        // Add toggle data to all boxes
        $(this).parent().attr('toggled', 'no');
            
        // On click of analyse box fire trigger
        $(this).on('click', function() {
            // Save clicked analyse box in separate variable
            // Save toggle state of clicked anayluse box in variable
            var $analyseBox = $(this).parent();
                toggleState = $analyseBox.attr('toggled');

            // Open the coretasks list
            if( toggleState === 'no' ) {
                // Find all coretasks under clicked analyse box and trigger for each of them separetly
                $analyseBox.find($targetToOpen).each( function() {
                    // Slide open the coretasks boxes
                    $(this).stop().slideDown('fast');
                    // Change the toggle state of clicked analyse box
                    $analyseBox.attr('toggled', 'yes');
                });
            }
            // Close the coretasks list
            if( toggleState === 'yes' ) {
                // Find all coretasks under clicked analyse box and trigger for each of them separetly
                $analyseBox.find($targetToOpen).each( function() {
                    // Slide shut the coretasks boxes
                    $(this).stop().slideUp('fast');
                    // Change the toggle state of clicked analyse box
                    $analyseBox.attr('toggled', 'no');
                })
            }

        });
    });
}

$(function() {
    // Init anaylse dropdown
    // ~ Profile
    analyseDropdown('.coretask-box');
    analyseDropdown('.workprocess-box');
    // ~ Admin
    analyseDropdown('.add-workprocess-form');
    // ~ School
    analyseDropdown('.analyse-workprocess-select');

    // Switch between position relative and fixed for menu
    $(window).scroll( function() {
        var addRemClass = $(window).scrollTop() > 0 ? 'addClass' : 'removeClass';
        $(".navbar")[addRemClass]("scroll");
    });

    // Init select2
    $("#reviewer").select2();
    $(".analyse-workprocess-select-field").select2();
})