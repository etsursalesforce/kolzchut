$(function() {
    var chosen_categories = [];
    var templates = {};
    var req_id = 1;

    $.each(['selected-cat', 'documents', 'facets', 'guides'], function(i, key) {
        templates[key] = $('#'+key+'-tmpl').html();
        Mustache.parse(templates[key]);
    });

    var curr_cat = $('#filter').data('category');
    if (curr_cat) {
        $.ajax({
            url: '/solr-filter/ajax-search-documents.php',
            dataType: 'json',
            data: {
                category: curr_cat
            },
            success: function( data ) {
                if (data.numDocuments) {
                    addCat(curr_cat);
                }
            }
        });
    }

    $('#search-categories input').autocomplete({
        position: {
            my : "right top",
            at: "right bottom"
        },
        source: function( request, response ) {
            $.ajax({
                url: '/solr-filter/ajax-search-documents.php',
                dataType: 'json',
                data: {
                    term: request.term,
                    category: chosen_categories
                },
                success: function( data ) {
                    response( data.facets );
                }
            });
        },
        minLength: 2,
        select: function( event, ui ) {
            addCat(ui.item.category);
            $(this).val('');
            return false;
        }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<a class='ac-cat'>" + item.category + "</a><span>(" + item.count + ")</span>" )
            .appendTo( ul );
    };

    $('#active-categories').on('click', 'span.close', function(e) {
        var category = $(this).prev('span').text();
        $(this).closest('.category').remove();
        var index = chosen_categories.indexOf(category);
        if (index === false) return alert('unknown category');
        chosen_categories.splice(index,1);
        findDocs();
    });

    $('#proposed-categories').on('click', '.category .cat', function(e) {
        addCat($(this).text());
    });

    function addCat(cat) {
        var rendered = Mustache.render(templates['selected-cat'], {cat: cat});
        $('#active-categories').append(rendered);
        chosen_categories.push(cat);
        findDocs();
    }
    function findDocs() {
        var currReq = ++req_id;
        if (!chosen_categories.length) {
            $('#results').html('');
            $('#proposed-categories').html('');
            return;
        }
        $.ajax({
            url: '/solr-filter/ajax-search-documents.php',
            dataType: 'json',
            data: {
                category: chosen_categories
            },
            success: function( data ) {
                if (currReq != req_id) {
                    return;
                }
                var results = '';
                if (data['guides'] && data['guides'].length) {
                    results += Mustache.render(templates['guides'], {title: 'זכותונים ומדריכים', items: data['guides']});
                }
                if (data['portals'] && data['portals'].length) {
                    results += Mustache.render(templates['guides'], {title: 'פורטלים', items: data['portals']});
                }
                results += Mustache.render(templates['documents'], data);
                $('#results').html(results);

                $('#proposed-categories').html(Mustache.render(templates['facets'], data));
            }

        });
    }

});