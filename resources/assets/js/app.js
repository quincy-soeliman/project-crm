function analyseDropdown() {
    $('.trigger-dropdown').attr('toggled', 'no');

    $('.trigger-dropdown').each( function() {
        var $this = $(this);
        var $testTarget = $this.attr('toslidedown');

        if( $this.parent().find($testTarget).length === 0 ) {
            $this.parent().addClass("hide");
        }
    });

    $(".trigger-dropdown").on('click', function() {
        var $trigger = $(this);
        var $target = $(this).attr('toslidedown');
        var toggleState = $(this).attr('toggled');

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
    $(".user-container").each( function() {
        var $this = $(this);

        if( $this.find('.user').length == 0 ) {
            $this.hide();
        }
    });
}

function initSelect2() {
    $("#reviewer").select2();
    $(".analyse-workprocess-select-field").select2();
}

$(function() {
    // Init anaylse dropdown
    analyseDropdown();

    // Cheack if has users
    hasUsers();

    // Init select2
    initSelect2();
})