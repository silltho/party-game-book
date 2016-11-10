/**
 * Created by PhpStorm.
 * User: Thomas Siller
 * Zweck: MMP1
 * Studiengang: MultiMediaTechnology
 * 2016, Fachhochschule Salzburg
 */
var currentTagIndex = 0;
var currentMaterialIndex = 0;
$(function() {
    $(document).foundation(); //foundation.js init
    tinymce.init({
        selector:'textarea',
        language: 'de',
        style_formats:
            [
                {
                    title:'Headers',
                    items:[
                        {
                            title:'Header 4',
                            format:'h4'
                        },
                        {
                            title:'Header 5',
                            format:'h5'
                        },
                        {
                            title:'Header 6',
                            format:'h6'
                        }
                    ]
                },
                {
                    title:'Inline',
                    items:[
                        {
                            title:'Bold',
                            icon:'bold',
                            format:'bold'
                        },
                        {
                            title:'Italic',
                            icon:'italic',
                            format:'italic'
                        },
                        {
                            title:'Underline',
                            icon:'underline',
                            format:'underline'
                        },
                        {
                            title:'Strikethrough',
                            icon:'strikethrough',
                            format:'strikethrough'
                        },
                        {
                            title:'Superscript',
                            icon:'superscript',
                            format:'superscript'
                        },
                        {
                            title:'Subscript',
                            icon:'subscript',
                            format:'subscript'
                        },
                        {
                            title:'Code',
                            icon:'code',
                            format:'code'
                        }
                    ]
                },
                {
                    title:'Blocks',
                    items:[
                        {
                            title:'Paragraph',
                            format:'p'
                        },
                        {
                            title:'Blockquote',
                            format:'blockquote'
                        },
                        {
                            title:'Div',
                            format:'div'
                        },
                        {
                            title:'Pre',
                            format:'pre'
                        }
                    ]
                },
                {
                    title:'Alignment',
                    items:[
                        {
                            title:'Left',
                            icon:'alignleft',
                            format:'alignleft'
                        },
                        {
                            title:'Center',
                            icon:'aligncenter',
                            format:'aligncenter'
                        },
                        {
                            title:'Right',
                            icon:'alignright',
                            format:'alignright'
                        },
                        {
                            title:'Justify',
                            icon:'alignjustify',
                            format:'alignjustify'
                        }
                    ]
                }
            ]
    }); //tinymce init

    var options = {
        valueNames: [ 'name', 'id' ]
    };
    var tagList = new List('tag-list', options); //init tag-list filtering
    var maerialList = new List('material-list', options); //init material-list filtering

    currentTagIndex = $("#tagCounter").html();
    currentMaterialIndex = $("#materialCounter").html();

    //game search autocomplete
    $( ".game-input" ).autocomplete({
        source: sourceGame,
        minLength: 2
    });

    $( "#tag-list > .list > li" ).click(function(event) {
        event.preventDefault();
        var item = {
            value: $(event.currentTarget).children('.id').html(),
            label: $(event.currentTarget).children('.name').html()
        };
        $ ("#selected-tags" ).append(createTag(item));
    });

    $( "#material-list > .list > li" ).click(function(event) {
        event.preventDefault();
        var item = {
            value: $(event.currentTarget).children('.id').html(),
            label: $(event.currentTarget).children('.name').html()
        };
        $ ("#selected-materials" ).append(createMaterial(item));
    });

    $('body').on('click', '.removeBlockIcon', function(event) {
        $(event.target.parentElement).remove();
    });
});

function generateHiddenInputs(item, name, count) {
    var generatedString = "";
    generatedString += '<input type = "hidden" name = "'+ name +'[' + count + '][id]" value = "' + item.value + '" >';
    generatedString += '<input type = "hidden" name = "'+ name +'[' + count + '][name]" value = "' + item.label + '" >';
    return generatedString;
}



function createTag(item){
    var formItem = '<div class="block">' + item.label + '<i class="fi-x-circle removeBlockIcon"></i>' + generateHiddenInputs(item, 'tags', currentTagIndex) + '</div>';
    currentTagIndex++;
    return formItem;
}

function createMaterial(item){
    var formItem = '<div class="block">' + item.label + '<i class="fi-x-circle removeBlockIcon"></i>' + generateHiddenInputs(item, 'materials', currentMaterialIndex) + '</div>';
    currentMaterialIndex++;
    return formItem;
}

function sourceGame(request, response){
    $.getJSON(APP_PATH+'/api/games.php?term=' + request.term, function(data){
        var responseData = [];
        $.each(data, function(index, item) { //format json response
            responseData[index] = {'label': item.gamename, 'value': item.gamename};
        });
        response(responseData);
    })
}