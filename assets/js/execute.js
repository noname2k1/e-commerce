const ajaxCallPOST = (url, data, callback) => {
    $.ajax({
        method: 'POST',
        url,
        data,
        dataType: 'json',
        success: function (response) {
            callback(response);
            if (response.error) {
                console.log(response.error);
            }
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
            callback(response);
            if (response.error) {
                console.log(response.error);
            }
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
            callback(response);
            if (response.error) {
                console.log(response.error);
            }
        },
    });
};
