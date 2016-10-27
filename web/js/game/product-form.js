$(function () {
    $('#isPackage').on('change', function (event) {
        var $owner = $(this),
            $package = $('#packageContent');
        console.info($owner);
        if ($owner.prop('checked')) {
            $package.show();
        }
        else {
            $package.hide();
        }
    });

    $('.deleteExist').on('click', function(event) {
        var $owner = $(this);
        if (confirm('Delete?')) {
            $owner.closest('tr').remove();
        }
    });

    $('#addToPackage').on('click', function(event) {
        var $gameProduct = $('#gameProduct'),
            $gameProductCount = $('#gameProductCount');

        var $selectedGameProduct = $gameProduct.find(':selected');

        if ($selectedGameProduct.val() != '' && !$selectedGameProduct.prop('disabled')) {

            var $newGameProductCount = $gameProductCount.clone();
            $newGameProductCount.attr({
                name: 'package['+$selectedGameProduct.val()+']',
                id: '',
                class: 'span2'
            });
            var $newDeleteButton = $('<button>', {
                class: 'btn btn-danger',
                html: 'Delete'
            }).on('click', function(event) {
                if (confirm('Delete?')) {
                    $selectedGameProduct.removeAttr('disabled');
                    $(this).closest('tr').remove();
                }
            });


            var $title = $('<td>', {
                html: $selectedGameProduct.html()
            });
            var $count = $('<td>').append($newGameProductCount);
            var $action = $('<td>').append($newDeleteButton);
            var $controls = $('<tr>').append($title).append($count).append($action);

            $('#package tr:first-child').after($controls);
            $selectedGameProduct.attr('disabled', 'disabled').removeAttr('selected');
        }


    });
});