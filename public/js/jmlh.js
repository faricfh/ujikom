var grabedurl = window.location.pathname;
var url = "/api" + grabedurl;

$.ajax({
    url: '/totalproduk',
    method: 'GET',
    dataType: 'json',
    success: function(get) {
        $('#totalproduk').append(
            `
                ${get}
                `
        )
    },
    error: function(data) {
        //
    }
})