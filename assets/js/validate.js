const validateForm = (callback) => {
    var usernameRegex = /^[A-Za-z][A-Za-z0-9_]{4,30}$/;
    // var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,}$/;
    var passwordRegex = /^(?=.*\d).{6,}$/;
    var emailRegex =
        /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var phoneRegex = /^[0-9]{10}$/;
    var nameRegex =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    var addressRegex =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    var cityRegex =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    var stateRegex =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    var zipRegex = /^[0-9]{6}$/;
    var countryRegex =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    var cardRegex = /^[0-9]{16}$/;
    var cvvRegex = /^[0-9]{3}$/;
    var expRegex = /^[0-9]{2}$/;
    var nameOnCardRegex =
        /^[^\s]+([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+[^\s])$/i;
    var decriptionRegex = /^[A-Za-z][A-Za-z0-9_]{5,255}$/;
    var priceRegex = /^[0-9]{1,}$/;
    var quantityRegex = /^[0-9]{1,}$/;
    var sizeRegex =
        /^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ,\s]+)$/i;
    var colorRegex =
        /^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ,\s]+)$/i;
    $(document).on('submit', 'form#crud', function (e) {
        const inputTypePassword = document.querySelector(
            'input[type="password"]'
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
            !usernameRegex.test($('input[name="username"]').val())
        ) {
            $('input[name="username"]').addClass('invalid');
            return displayToast(
                'error',
                'username must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores'
            );
        }
        //password
        if (
            inputTypePassword &&
            !passwordRegex.test($('input[name="password"]').val())
        ) {
            $('input[name="password"]').addClass('invalid');
            return displayToast(
                'error',
                'password must be 6 characters, contain at least one number'
            );
        }
        if (
            $('input[name="cfpassword"]') &&
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
        if (
            inputTypePhone &&
            !phoneRegex.test($('input[name="phone"]').val())
        ) {
            $('input[name="phone"]').addClass('invalid');
            return displayToast('error', 'phone is not valid');
        }
        //name
        if (inputTypeName && !nameRegex.test($('input[name="name"]').val())) {
            $('input[name="name"]').addClass('invalid');
            return displayToast(
                'error',
                'name must be 3-20 characters, start with a letter or number, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //address
        if (
            inputTypeAddress &&
            !addressRegex.test($('input[name="address"]').val())
        ) {
            $('input[name="address"]').addClass('invalid');
            return displayToast(
                'error',
                'address must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //city
        if (inputTypeCity && !cityRegex.test($('input[name="city"]').val())) {
            $('input[name="city"]').addClass('invalid');
            return displayToast(
                'error',
                'city must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //state
        if (
            inputTypeState &&
            !stateRegex.test($('input[name="state"]').val())
        ) {
            $('input[name="state"]').addClass('invalid');
            return displayToast(
                'error',
                'state must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //zip
        if (inputTypeZip && !zipRegex.test($('input[name="zip"]').val())) {
            $('input[name="zip"]').addClass('invalid');
            return displayToast('error', 'zip is not valid');
        }
        //country
        if (
            inputTypeCountry &&
            !countryRegex.test($('input[name="country"]').val())
        ) {
            $('input[name="country"]').addClass('invalid');
            return displayToast(
                'error',
                'country must be 3-20 characters, start with a letter, and contain only letters, numbers, and underscores or spaces, no spaces at the beginning or end'
            );
        }
        //card
        if (inputTypeCard && !cardRegex.test($('input[name="card"]').val())) {
            $('input[name="card"]').addClass('invalid');
            return displayToast('error', 'card is not valid');
        }
        //cvv
        if (inputTypeCvv && !cvvRegex.test($('input[name="cvv"]').val())) {
            $('input[name="cvv"]').addClass('invalid');
            return displayToast('error', 'cvv is not valid');
        }
        //exp
        if (inputTypeExp && !expRegex.test($('input[name="exp"]').val())) {
            $('input[name="exp"]').addClass('invalid');
            return displayToast('error', 'exp is not valid');
        }
        //nameOnCard
        if (
            inputTypeNameOnCard &&
            !nameOnCardRegex.test($('input[name="nameOnCard"]').val())
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
            !decriptionRegex.test($('input[name="decription"]').val())
        ) {
            $('input[name="decription"]').addClass('invalid');
            return displayToast(
                'error',
                'decription must be 5-255 characters, start with a letter, and contain only letters, numbers, and underscores'
            );
        }
        //price
        if (
            inputTypePrice &&
            !priceRegex.test($('input[name="price"]').val())
        ) {
            $('input[name="price"]').addClass('invalid');
            return displayToast('error', 'price is not valid');
        }
        //quantity
        if (
            inputTypeQuantity &&
            !quantityRegex.test($('input[name="quantity"]').val())
        ) {
            $('input[name="quantity"]').addClass('invalid');
            return displayToast('error', 'quantity is not valid');
        }
        //size
        if (inputTypeSize && !sizeRegex.test($('input[name="size"]').val())) {
            $('input[name="size"]').addClass('invalid');
            return displayToast('error', 'size must be 1-255 characters');
        }
        //color
        if (
            inputTypeColor &&
            !colorRegex.test($('input[name="color"]').val())
        ) {
            $('input[name="color"]').addClass('invalid');
            return displayToast(
                'error',
                'color must be 1-255 characters, start with a letter, and contain only letters, numbers, and underscores'
            );
        }

        callback();
    });
};
