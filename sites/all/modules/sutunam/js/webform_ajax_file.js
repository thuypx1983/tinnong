(function ($) {

    // Overwrite Drupal.file.disableFields from file module to
    // allow file fields being submitted when submitting through
    // ajax.
    Drupal.file.disableFields = function (event){
        var clickedButton = this;

        // Do not disable fields for non-ajax buttons and the
        // webform ajax submit button.
        if (!$(clickedButton).hasClass('ajax-processed') || $(clickedButton).hasClass('webform-ajax-submit')) {
            return;
        }

        // Check if we're working with an "Upload" button.
        var $enabledFields = [];
        if ($(this).closest('div.form-managed-file').length > 0) {
            $enabledFields = $(this).closest('div.form-managed-file').find('input.form-file');
        }

        // Temporarily disable upload fields other than the one we're currently
        // working with. Filter out fields that are already disabled so that they
        // do not get enabled when we re-enable these fields at the end of behavior
        // processing. Re-enable in a setTimeout set to a relatively short amount
        // of time (1 second). All the other mousedown handlers (like Drupal's Ajax
        // behaviors) are excuted before any timeout functions are called, so we
        // don't have to worry about the fields being re-enabled too soon.
        // @todo If the previous sentence is true, why not set the timeout to 0?
        var $fieldsToTemporarilyDisable = $('div.form-managed-file input.form-file').not($enabledFields).not(':disabled');
        $fieldsToTemporarilyDisable.attr('disabled', 'disabled');
        setTimeout(function (){
            $fieldsToTemporarilyDisable.attr('disabled', false);
        }, 1000);
    }

}(jQuery));