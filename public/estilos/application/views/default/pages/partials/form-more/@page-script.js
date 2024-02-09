jQuery(function($) {

    // bootstrap select
    $.fn.selectpicker.Constructor.DEFAULTS.tickIcon = 'far fa-check-square text-125 text-orange mt-1';


    $('#selectpicker1').selectpicker();
    $('#selectpicker2').selectpicker();
    $('#selectpicker3').selectpicker();


    if ($('.chosen-select').length)
    {
        $(".chosen-select").chosen({allow_single_deselect: true});
    }

    if ($('#tag-input').length) {

        $('#tag-input').tagsinput({
            tagClass: 'badge badge-secondary font-normal',
            focusClass: 'tagsinput-focus'
        });
    }

    if ($('#tag-input2').length) {

        $('#tag-input2').tagsinput({
            tagClass: 'badge badge-secondary font-normal',
            focusClass: 'tagsinput-focus'
        });
    }

    if ($('.select2').length) {
        $('.select2').select2({
            allowClear: true,
            dropdownParent: $('#select2-parent'),
        })
    }

    if($('input.typeahead').length) {

        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        // the typeahead jQuery plugin expects suggestions to a
                        // JavaScript object, refer to typeahead docs for more info
                        matches.push({ value: str });
                    }
                });

                cb(matches);
            }
        }

        var US_STATES = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"]
        $('input.typeahead').typeahead(
            {
                hint: true,
                highlight: true,
                minLength: 1,
                classNames: {
                    menu: 'dropdown-menu',
                    suggestion: 'dropdown-item',
                    cursor: 'bgc-yellow-m2'
                }
            },
            {
                name: 'states',
                displayKey: 'value',
                source: substringMatcher(US_STATES),
                limit: 10
            }
        );
    }
})
