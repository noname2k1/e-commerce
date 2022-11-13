const validateForm = (callback) => {
    const username = /^[A-Za-z][A-Za-z0-9_]{5,19}$/;
    // const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,}$/;
    const password = /^(?=.*\d).{6,}$/;
    const emailRegex =
        /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const phone = /^[0-9]{10}$/;
    const name =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    const address =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    const city =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    const state =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    const zip = /^[0-9]{6}$/;
    const country =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    const card = /^[0-9]{16}$/;
    const cvv = /^[0-9]{3}$/;
    const exp = /^[0-9]{2}$/;
    const nameOnCard =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    const description = /^[A-Za-z][A-Za-z0-9_]{5,255}$/;
    const price = /^[0-9]{1,}$/;
    const quantity = /^[0-9]{1,}$/;
    const size =
        /^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ,\s]+)$/i;
    const color =
        /^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ,\s]+)$/i;
    $(document).on('submit', 'form#crud', function (e) {
        const inputTypePassword = document.querySelector(
            'input[type="password"]'
        );
        const inputcfPassword = document.querySelector(
            'input[name="cfpassword"]'
        );
        const inputTypeEmail = document.querySelector('input[type="email"]');
        const inputTypePhone = document.querySelector('input[type="tel"]');
        const inputTypeCard = document.querySelector('input[name="card"]');
        const inputTypeCvv = document.querySelector('input[name="cvv"]');
        const inputTypeExp = document.querySelector('input[name="exp"]');
        const inputTypeZip = document.querySelector('input[name="zip"]');
        const inputTypePrice = document.querySelector('input[name="price"]');
        const inputTypeQuantity = document.querySelector(
            'input[name="quantity"]'
        );
        const inputTypeSize = document.querySelector('input[name="size"]');
        const inputTypeColor = document.querySelector('input[name="color"]');
        const inputTypeDescription = document.querySelector(
            'textarea[name="description"]'
        );
        const inputTypeUsername = document.querySelector(
            'input[name="username"]'
        );
        const inputTypeName = document.querySelector('input[name="name"]');
        const inputTypeAddress = document.querySelector(
            'input[name="address"]'
        );
        const inputTypeCity = document.querySelector('input[name="city"]');
        const inputTypeState = document.querySelector('input[name="state"]');
        const inputTypeCountry = document.querySelector(
            'input[name="country"]'
        );
        const inputTypeNameOnCard = document.querySelector(
            'input[name="nameOnCard"]'
        );
        e.preventDefault();
        //username
        if (
            inputTypeUsername &&
            !username.test($('input[name="username"]').val())
        ) {
            $('input[name="username"]').addClass('invalid');
            return displayToast(
                'error',
                'username must be 6-20 characters, start with a letter, and contain only letters, numbers, and underscores'
            );
        }
        //password
        if (
            inputTypePassword &&
            !password.test($('input[name="password"]').val())
        ) {
            $('input[name="password"]').addClass('invalid');
            return displayToast(
                'error',
                'password must be 6 characters, contain at least one number'
            );
        }
        if (
            inputcfPassword &&
            inputTypePassword &&
            $('input[name="password"]').val() !==
                $('input[name="cfpassword"]').val()
        ) {
            $('input[name="cfpassword"]').addClass('invalid');
            return displayToast(
                'error',
                'password and confirm password must be the same'
            );
        }
        //email
        if (
            inputTypeEmail &&
            !emailRegex.test($('input[name="email"]').val())
        ) {
            $('input[name="email"]').addClass('invalid');
            return displayToast('error', 'email is not valid');
        }
        //phone
        if (inputTypePhone && !phone.test($('input[name="phone"]').val())) {
            $('input[name="phone"]').addClass('invalid');
            return displayToast('error', 'phone is not valid');
        }
        //name
        if (inputTypeName && !name.test($('input[name="name"]').val())) {
            $('input[name="name"]').addClass('invalid');
            return displayToast(
                'error',
                'name must be 3-20 characters, start with a letter or number, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //address
        if (
            inputTypeAddress &&
            !address.test($('input[name="address"]').val())
        ) {
            $('input[name="address"]').addClass('invalid');
            return displayToast(
                'error',
                'address must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //city
        if (inputTypeCity && !city.test($('input[name="city"]').val())) {
            $('input[name="city"]').addClass('invalid');
            return displayToast(
                'error',
                'city must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //state
        if (inputTypeState && !state.test($('input[name="state"]').val())) {
            $('input[name="state"]').addClass('invalid');
            return displayToast(
                'error',
                'state must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //zip
        if (inputTypeZip && !zip.test($('input[name="zip"]').val())) {
            $('input[name="zip"]').addClass('invalid');
            return displayToast('error', 'zip is not valid');
        }
        //country
        if (
            inputTypeCountry &&
            !country.test($('input[name="country"]').val())
        ) {
            $('input[name="country"]').addClass('invalid');
            return displayToast(
                'error',
                'country must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //card
        if (inputTypeCard && !card.test($('input[name="card"]').val())) {
            $('input[name="card"]').addClass('invalid');
            return displayToast('error', 'card is not valid');
        }
        //cvv
        if (inputTypeCvv && !cvv.test($('input[name="cvv"]').val())) {
            $('input[name="cvv"]').addClass('invalid');
            return displayToast('error', 'cvv is not valid');
        }
        //exp
        if (inputTypeExp && !exp.test($('input[name="exp"]').val())) {
            $('input[name="exp"]').addClass('invalid');
            return displayToast('error', 'exp is not valid');
        }
        //nameOnCard
        if (
            inputTypeNameOnCard &&
            !nameOnCard.test($('input[name="nameOnCard"]').val())
        ) {
            $('input[name="nameOnCard"]').addClass('invalid');
            return displayToast(
                'error',
                'nameOnCard must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //description
        if (
            inputTypeDescription &&
            !description.test($('input[name="decription"]').val())
        ) {
            $('input[name="decription"]').addClass('invalid');
            return displayToast(
                'error',
                'decription must be 5-255 characters, start with a letter, and contain only letters, numbers, and underscores'
            );
        }
        //price
        if (inputTypePrice && !price.test($('input[name="price"]').val())) {
            $('input[name="price"]').addClass('invalid');
            return displayToast('error', 'price is not valid');
        }
        //quantity
        if (
            inputTypeQuantity &&
            !quantity.test($('input[name="quantity"]').val())
        ) {
            $('input[name="quantity"]').addClass('invalid');
            return displayToast('error', 'quantity is not valid');
        }
        //size
        if (inputTypeSize && !size.test($('input[name="size"]').val())) {
            $('input[name="size"]').addClass('invalid');
            return displayToast('error', 'size must be 1-255 characters');
        }
        //color
        if (inputTypeColor && !color.test($('input[name="color"]').val())) {
            $('input[name="color"]').addClass('invalid');
            return displayToast(
                'error',
                'color must be 1-255 characters, start with a letter, and contain only letters, numbers, and underscores'
            );
        }

        callback();
    });
};

const validateInput = (input) => {
    if (!input) return;
    const inputName = input.attr('name');
    const inputVal = input.val();
    switch (inputName) {
        case 'username':
            if (!username.test(inputVal)) {
                input.addClass('invalid');
                return 'username must be 3-20 characters, start with a letter or number, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end';
            } else {
                input.removeClass('invalid');
            }
            break;
        case 'password':
            if (!password.test(inputVal)) {
                input.addClass('invalid');
                return 'password must be 6 characters, contain at least one number';
            } else {
                input.removeClass('invalid');
            }
            break;
        case 'email':
            if (!email.test(inputVal)) {
                input.addClass('invalid');
                return 'email is not valid';
            } else {
                input.removeClass('invalid');
            }
            break;
        case 'name':
            if (!name.test(inputVal)) {
                input.addClass('invalid');
                return 'name must be 3-20 characters, start with a letter or number, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end';
            } else {
                input.removeClass('invalid');
            }
            break;
        case 'cfpassword':
            if (inputVal !== $('input[name="password"]').val()) {
                input.addClass('invalid');
                return 'passwords do not match';
            } else {
                input.removeClass('invalid');
            }
        default:
            break;
    }
};
