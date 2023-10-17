$(document).on('click', '#first', function () {
    if (offset >= limit) {
        offset = 0;
        refreshgrid();
    }
});

$(document).on('click', '#last', function () {
    if ((offset + limit) < total) {
        offset = last_offset;
        refreshgrid();
    }
});

$(document).on('click', '#prev', function () {
    if (offset >= limit) {
        offset = offset - limit;
        refreshgrid();
    }
});

$(document).on('click', '#next', function () {
    if ((offset + limit) < total) {
        offset = offset + limit;
        refreshgrid();
    }
});

$(document).on('submit', '#search-form', function (event) {
    event.preventDefault();
});

$(document).on('keyup', '#search', function (event) {
    if (event.keyCode === 13) {
        refreshgrid();
    }
});

$(document).on('click', '#go', function () {
    refreshgrid();
});

$(document).on('change', '.filter', function () {
    refreshgrid();
});

function refreshgrid() {
    var form_data = 'ajax=1&action=refresh';
    form_data = 'offset=' + offset + '&limit=' + limit + '&' + form_data;
    form_data = $('#filter-form').serialize() + '&' + form_data;
    search = $('#search').val();
    if (search != '') {
        form_data = 'search=' + search + '&' + form_data;
    }
    $.ajax({
        url: call_function, //The url where the server req would we made.
        async: false,
        type: "POST", //The type which you want to use: GET/POST
        data: form_data, //The variables which are going.
        dataType: "html", //Return data type (what we expect).
        success: function (data) {
            $('#grid').html(data);
            total = $('#total').val();
            $('#label-total').html('Total ' + total);
            if (total == 0) {
                total_pages = 0;
                offset = 0;
                page_no = 0;
            } else {
                total_pages = Math.ceil(total / limit);
                last_offset = (total_pages - 1) * limit;
                if (offset > last_offset) {
                    offset = last_offset;
                }
                page_no = (offset / limit) + 1;
            }
            $('#page_no').html(page_no + ' of ' + total_pages);
        }
    });
}