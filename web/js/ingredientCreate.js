
var $collectionHolder;

var $addIngredientLink = $('<a href="#" class="add_ingredient_link">Добави съставка</a>');
var $newLinkLi = $('<li></li>').append($addIngredientLink);

jQuery(document).ready(function () {
    $collectionHolder = $('ul.ingredients');

    $collectionHolder.append($newLinkLi);
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addIngredientLink.on('click', function (e) {
        e.preventDefault();

        addIngredientForm($collectionHolder, $newLinkLi);
    });
});

function addIngredientForm($collectionHolder, $newLinkLi) {

    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');

    var newForm = prototype.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);

    $newFormLi.append('<a href="#" class="remove-ingredient">Премахни</a>');
    $newLinkLi.before($newFormLi);

    $('.remove-ingredient').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}