$(function() {
    $('input[type=checkbox]').change(
	function() {
	    $('input').closest('div').removeClass('checked');
	    $(':checked').closest('div').addClass('checked');
	}
    ).trigger('change');
});

$("input[type='checkbox']").change(function () {//チェックボックスの内容が変更されたとき。
    if ($(".checkbox:checked").length >= 1) {//チェックされているチェックボックスが1つ以上あれば
	$("#send").prop("disabled", false);//送信ボタンを有効化する。
    } else {
	$("#send").prop("disabled", true);//送信ボタンを無効化する。
    }
});

/*
  以下isotope設定用
 */
var $grid = $('.grid').isotope({
    itemSelector: '.element-item'
});

// store filter for each group
var filters = {};

$('.filters').on( 'click', '.button', function() {
    var $this = $(this);
    // get group key
    var $buttonGroup = $this.parents('.button-group');
    var filterGroup = $buttonGroup.attr('data-filter-group');
    // set filter for group
    filters[ filterGroup ] = $this.attr('data-filter');
    // combine filters
    var filterValue = concatValues( filters );
    // set filter for Isotope
    $grid.isotope({ filter: filterValue });
});

// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
	$buttonGroup.find('.is-checked').removeClass('is-checked');
	$( this ).addClass('is-checked');
    });
});

// flatten object by concatting values
function concatValues( obj ) {
    var value = '';
    for ( var prop in obj ) {
	value += obj[ prop ];
    }
    return value;
}
