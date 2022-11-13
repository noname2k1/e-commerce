const ajaxCallPOST = (url, data, callback) => {
    $.ajax({
        method: 'POST',
        url,
        data,
        dataType: 'json',
        success: function (response) {
            console.log('ajax success');
            callback(response);
        },
    });
};

const ajaxCallUpload = (url, data, callback) => {
    $.ajax({
        method: 'POST',
        url,
        data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
            console.log('ajax success');
            callback(response);
        },
    });
};

const ajaxCallGET = (url, data, callback) => {
    $.ajax({
        method: 'GET',
        url,
        data,
        dataType: 'json',
        success: function (response) {
            console.log('ajax success');
            callback(response);
        },
    });
};
