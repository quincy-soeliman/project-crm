function analyseDropdown() {
    // Add toggle data to all boxes
    $(".analyse-box, .coretask-box").attr('toggled', 'no');

    // Triggers for analyse box dropdown
    // Do triggers for each analyse box sepparetly
    $(".analyse-box .trigger").each( function() {
        // On click of analyse box fire trigger
        $(this).on('click', function() {
            // Save clicked analyse box in separate variable
            // Save toggle state of clicked anayluse box in variable
            var $analyseBox = $(this).parent();
                toggleState = $analyseBox.attr('toggled');

            // Open the coretasks list
            if( toggleState === 'no' ) {
                // Find all coretasks under clicked analyse box and trigger for each of them separetly
                $analyseBox.find('.coretask-box').each( function() {
                    // Slide open the coretasks boxes
                    $(this).stop().slideDown('fast');
                    // Change the toggle state of clicked analyse box
                    $analyseBox.attr('toggled', 'yes');
                });
            }
            // Close the coretasks list
            if( toggleState === 'yes' ) {
                // Find all coretasks under clicked analyse box and trigger for each of them separetly
                $analyseBox.find('.coretask-box').each( function() {
                    // Slide shut the coretasks boxes
                    $(this).stop().slideUp('fast');
                    // Change the toggle state of clicked analyse box
                    $analyseBox.attr('toggled', 'no');
                })
            }

        });
    });

    // Triggers for coretask box dropdown
    // Do triggers for each coretas box sepparetly
    $(".coretask-box .trigger").each( function() {
        // On click of coretask box fire trigger
        $(this).on('click', function() {
            // Save clicked coretask box in separate variable
            // Save toggle state of clicked anayluse box in variable
            var $coretaskBox = $(this).parent();
                toggleState = $coretaskBox.attr('toggled');

            // Open the workprocess list
            if( toggleState === 'no' ) {
                // Find all workprocesses under clicked analyse box and trigger for each of them separetly
                $coretaskBox.find('.workprocess-box').each( function() {
                    // Slide open the workprocesses boxes
                    $(this).stop().slideDown('fast');
                    // Change the toggle state of clicked coretask box
                    $coretaskBox.attr('toggled', 'yes');
                });
            }
            // Close the workprocess list
            if( toggleState === 'yes' ) {
                // Find all workprocesses under clicked analyse box and trigger for each of them separetly
                $coretaskBox.find('.workprocess-box').each( function() {
                    // Slide shut the workprocesses boxes
                    $(this).stop().slideUp('fast');
                    // Change the toggle state of clicked coretask box
                    $coretaskBox.attr('toggled', 'no');
                })
            }

        });
    });
}

$(function() {
    // Init anaylse dropdown
    analyseDropdown();

    $(window).scroll( function() {
        var addRemClass = $(window).scrollTop() > 100 ? 'addClass' : 'removeClass';
        $(".navbar")[addRemClass]("scroll");
    });

    $("#reviewer").select2();
})