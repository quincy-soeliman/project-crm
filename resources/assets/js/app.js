function analyseDropdown() {
    // Append toggle attribute to all dropdown buttons
    $('.trigger-dropdown').attr('toggled', 'no');
    // Loop trough all triggers
    $('.trigger-dropdown').each( function() {
        // Save selectors in variables for easier use
        var $this = $(this);
        var $testTarget = $this.attr('toslidedown');
        /*
        Check if list is empty
        If so, hide it
         */
        if( $this.parent().find($testTarget).length === 0 ) {
            $this.parent().addClass("hide");
        }
    });
    // On trigger click fire function
    $(".trigger-dropdown").on('click', function() {
        // Save selectors in variables for easier use
        var $trigger = $(this);
        var $target = $(this).attr('toslidedown');
        var toggleState = $(this).attr('toggled');
        /*
        If togglestate of trigger === 'no'
        Open the dropdown
        Change togglestate of trigger to 'yes'
        Else
        Close dropdown
        Set togglestate of trigger to 'no'
         */
        if( toggleState === 'no' ) {
            $trigger.parent().find($target).each( function() {
                $(this).slideDown('fast', function() {
                    $trigger.attr('toggled', 'yes');
                });
            });
        } else {
            $trigger.parent().find($target).each( function() {
                $(this).slideUp('fast', function() {
                    $trigger.attr('toggled', 'no');
                });
            });
        }
    });
}

function hasUsers() {
    // Loop trough all user-containers 1 by 1
    $(".user-container").each( function() {
        // Save selector in variables for easier use
        var $this = $(this);
        /*
        If can't find container with class 'user'
        then hide the user-container
         */
        if( $this.find('.user').length == 0 ) {
            $this.hide();
        }
    });
}

function initSelect2() {
    // Simple init of select2 plugin
    $("#reviewer").select2();
    $(".analyse-workprocess-select-field").select2();
}

$(function() {
    // Init anaylse dropdown
    analyseDropdown();

    // Check if has users
    hasUsers();

    // Init select2
    initSelect2();
})