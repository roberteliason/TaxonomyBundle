(function ($) {
    'use strict';

    var tagOptions = {
        placeholder: '',
        multiple: true,
        tags: [],
        tokenSeparators: [','],
        initSelection: function (element, callback) {
            var data = [];
            $(element.val().split(',')).each(function () {
                data.push({id: this, text: this});
            });
            callback(data);
        },
        ajax: {
            url: function (search) {
                var vocab = $(this).attr('data-vocab');
                var uri = '/ajax/taxonomy/' + vocab;
                return search ? uri + '/' + search : uri;
            },
            dataType: 'json',
            data: function (term, page) {

            },
            results: function (data, page) {
                var terms = [];
                for (var term in data.terms) {
                    terms.push({
                        id: data.terms[term].name,
                        text: data.terms[term].name
                    });
                }
                return {results: terms};
            }
        },
        createSearchChoice: function (term) {
            return {id: term, text: term};
        }
    };

    $('input.term-tags').select2(tagOptions);

    var tagSingleOptions = $.extend({}, tagOptions);
    delete tagSingleOptions.tags;

    tagSingleOptions.multiple = false;
    tagSingleOptions.initSelection = function (element, callback) {
        var data = {
            id: element.val(),
            text: element.val()
        };
        callback(data);
    };

    $('input.term-tags-single').select2(tagSingleOptions);

})(jQuery);
