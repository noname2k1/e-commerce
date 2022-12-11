const submitButton = $('#submitButton');
const changePasswordForm = $('form[name="change-password__form"]');
const loader = $('#loader');
const validateChangePasswordForm = () => {
    if (
        !changePasswordForm.find('input[name="current-password"]').val() ||
        !changePasswordForm.find('input[name="new-password"]').val()
    ) {
        return 'Password is required';
    }
    if (
        changePasswordForm.find('input[name="new-password"]').val().length < 6
    ) {
        return 'Password must be at least 6 characters';
    }
    if (
        changePasswordForm.find('input[name="new-password"]').val() !=
        changePasswordForm.find('input[name="confirm-password"]').val()
    ) {
        return 'Passwords do not match';
    }
    return true;
};

changePasswordForm.submit(function (e) {
    e.preventDefault();
    loader.removeClass('d-none');
    const validation = validateChangePasswordForm();
    if (validation === true) {
        $.ajax({
            url: changePasswordForm.attr('action'),
            type: 'POST',
            data: changePasswordForm.serialize(),
            success: function (response) {
                loader.addClass('d-none');
                if (response == 'false') {
                    return toastr.error(
                        'Current password is incorrect',
                        'CHANGE PASSWORD',
                        { timeOut: 1500 }
                    );
                }
                toastr.success(
                    'Change password successfully',
                    'CHANGE PASSWORD',
                    { timeOut: 1500 }
                );
                alert('Change password successfully. Please login again');
                $.post('index.php', { logout: true }, function (response) {
                    location.href = 'sign-in.php';
                });
            },
        });
    } else {
        toastr.error(validation, 'CHANGE PASSWORD', { timeOut: 1500 });
        loader.addClass('d-none');
    }
});

const resetChangePasswordForm = () => {
    changePasswordForm.find('input[name="current-password"]').val('');
    changePasswordForm.find('input[name="new-password"]').val('');
    changePasswordForm.find('input[name="confirm-password"]').val('');
};

$(document).on('click', '.user-menu-item.change-password', function () {
    $('.mainDiv').removeClass('d-none');
    changePasswordForm.find('input[name="current-password"]').focus();
});
$(document).on('click', '.mainDiv', function (e) {
    $('.mainDiv').addClass('d-none');
    resetChangePasswordForm();
});

$(document).on('click', '.cardStyle', function (e) {
    e.stopPropagation();
});
