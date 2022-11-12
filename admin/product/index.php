<?php
include_once '../model/product.php';
include_once '../model/brand.php';
include_once '../model/category.php';
?>
<style>
.table>tbody {
    vertical-align: unset;
}
</style>
<button class="btn btn-success m-1 add-product__btn">Add product</button>
<!-- product form -->
<form class="p-3 d-none bg-light fixed-bottom" id='crud'>
    <h2>add product</h2>
    <input type="hidden" name="id">
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="name" aria-label="name" name="name" required />
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="price" aria-label="price" name="price" required />
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="size phân cách bởi dấu , " aria-label="size"
                name="size" required />
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="màu phân cách bởi dấu , " aria-label="color"
                name="color" required />
        </div>
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">img</label>
        <input type="file" class="form-control" id="img" name="file" required />
        <input class="form-control img-link d-none" type="text" name='img' placeholder="img" required disabled>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">file / img-link</label>
        </div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <textarea class="form-control" id="description" rows="3"
            placeholder="description(mô tả): nhiều dòng mô tả - mỗi dòng cách nhau bởi dấu ," name="description"
            required></textarea>
    </div>
    <div class="mb-3">
        <label for="specs" class="form-label">specs</label>
        <textarea class="form-control" id="specs" rows="3"
            placeholder="đặc điểm: nếu nhiều đặc điểm - mỗi đặc điểm cách nhau bởi dấu ," name="specs"
            required></textarea>
    </div>
    <div class="mb-3 row">
        <div class="col">
            <label for="quantity" class="form-label">quantity</label>
            <input class="form-control" id="quantity" placeholder="quantity" name="quantity" required />
        </div>
        <div class="col">
            <label for="discount_percent" class="form-label">discount percent (%)</label>
            <input class="form-control" id="discount_percent" placeholder="discount percent" name="discount_percent"
                required />
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <select class="form-select" id="" name="category_id" required>
                <option selected value="NULL">Choose category...</option>
                <?php 
                $categories= get_all_category(); //result is a array
                if ($categories) {
                    foreach ($categories as $category) {
                        echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col">
            <select class="form-select" id="" name="brand_id" required>
                <option selected value="NULL">Choose brand...</option>
                <?php 
                $brands= get_all_brand(); //result is a array
                if ($brands) {
                    foreach ($brands as $brand) {
                        echo '<option value="'.$brand['id'].'">'.$brand['name'].'</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary add__btn submit">Submit</button>
        <input type="reset" class="btn btn-danger cancel__btn d-none ms-2" value="Cancel">
    </div>
</form>
<div class="toast-container top-0 end-0 p-3">
    <div role="alert" aria-live="assertive" aria-atomic="true"
        class="toast align-items-center text-bg-success border-0"></div>
</div>
<div class="toast-container top-0 end-0 p-3">
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast align-items-center text-bg-danger border-0">
    </div>
</div>
<!-- product LIST -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">name</th>
            <th scope="col">price</th>
            <th scope="col">size</th>
            <th scope="col">color</th>
            <th scope="col">img</th>
            <th scope="col">quantity</th>
            <th scope="col">description & specs</th>
            <th scope="col">disc.</th>
            <th scope="col">category_id</th>
            <th scope="col">brand_id</th>
            <th scope="col">options</th>
        </tr>
    </thead>
    <tbody>
        <?php
    $products= get_all_product(); //result is a array
    if ($products) {
        foreach ($products as $product) {
            echo '<tr>';
            echo "<th scope='row'>{$product['id']}</th>";
            echo "<td>{$product['name']}</td>";
            echo "<td>{$product['price']}</td>";
            echo "<td>{$product['size']}</td>";
            echo "<td>{$product['color']}</td>";
            echo "<td><img src='{$product['img']}' alt='thuong-mai-dien-tu'></td>";
            echo "<td>{$product['quantity']}</td>";
            echo "<td class='description__td'>{$product['description_and_specs']}</td>";
            echo "<td>{$product['discount_percent']}</td>";
            echo "<td>{$product['category_id']}</td>";
            echo "<td>{$product['brand_id']}</td>";
            echo "<td> <button class='btn btn-warning open-edit__btn me-1'><i class='bi bi-pen-fill'></i>Edit</button><button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#id-{$product['id']}'>delete<i class='bi bi-person-x-fill'></i></button><!-- Modal -->
            <div class='modal fade' id='id-{$product['id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Delete Category - ID: {$product['id']}</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                  </div>
                  <div class='modal-body'>
                    Are you sure delete this product?
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                    <button type='button' class='btn btn-primary delete__btn'data-bs-dismiss='modal' data-id='{$product['id']}' data-name='{$product['name']}'>Yes</button>
                  </div>
                </div>
              </div>
            </div></td>";
            echo '</tr>';
        }
    } else {
      echo "<tr>
      <td colspan='10' align='center'><b>no product</b></td>
      </tr>";
    }
?>
    </tbody>
</table>

<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const title = $('form > h2');
    const button = $('button[type="submit"].submit');
    const cancelBtn = $('input[type="reset"].cancel__btn');
    const loading = $('.loading');
    const addProductBtn = $('.add-product__btn');
    const form = $('form#crud');
    //display form
    addProductBtn.click(function() {
        if (form.hasClass('d-none')) {
            form.removeClass('d-none');
            addProductBtn.addClass('d-none');
            title.text('Add product');
            button.text('Add');
            cancelBtn.removeClass('d-none');
        }
    })
    //switch input file and input text
    const switchBtn = $('input[type="checkbox"].form-check-input');
    const fileInput = $('input[type="file"].form-control');
    const textInput = $('input[type="text"].img-link');
    switchBtn.change(function() {
        if (switchBtn.prop('checked')) {
            fileInput.prop('disabled', true);
            textInput.prop('disabled', false);
            fileInput.addClass('d-none');
            textInput.removeClass('d-none');
        } else {
            fileInput.prop('disabled', false);
            textInput.prop('disabled', true);
            fileInput.removeClass('d-none');
            textInput.addClass('d-none');
        }
    });
    //cancel button handle click
    cancelBtn.click(function() {
        $(this).addClass('d-none');
        title.text('add product');
        button.addClass('add__btn');
        button.removeClass('edit__btn');
        switchBtn.click();
        form.addClass('d-none');
        addProductBtn.removeClass('d-none');
    });
    // edit btn handle click
    $(document).on('click', '.btn.open-edit__btn', function() {
        const grandfarther = $(this).parent().parent();
        const childrens = grandfarther.children();
        const array = Array.from(childrens);
        const cArray = array.map((item, index) => {
            if (item.children[0]) {
                if (item.children[0].tagName === 'IMG') {
                    return item.children[0];
                }
                if (item.children[0].tagName === 'SPAN') {
                    return item.innerText.slice(
                        0,
                        item.children[0].innerText.length * -1
                    );
                }
            }
            return item.innerText;
        });
        $('input[name="id"]').val(cArray[0]);
        $('input[name="name"]').val(cArray[1]);
        $('input[name="price"]').val(cArray[2]);
        $('input[name="size"]').val(cArray[3]);
        $('input[name="color"]').val(cArray[4]);
        $('input[name="img"]').val(cArray[5].getAttribute('src'));
        $('textarea[name="description"]').val(cArray[7].indexOf('description') !== -1 ? JSON.parse(
                cArray[7])
            .description : cArray[7]);
        $('textarea[name="specs"]').val(cArray[7].indexOf('specs') !== -1 ? JSON.parse(cArray[7])
            .specs : '');
        $('input[name="quantity"]').val(cArray[6]);
        $('input[name="discount_percent"]').val(cArray[8]);
        $('select[name="category_id"]').val(cArray[9]);
        $('select[name="brand_id"]').val(cArray[10]);
        title.text('edit product - ID: ' + cArray[0]);
        switchBtn.click();
        cancelBtn.removeClass('d-none');
        button.removeClass('add__btn');
        button.addClass('edit__btn');
        button.text('Edit');
        form.removeClass('d-none');
        addProductBtn.addClass('d-none');
    });
    const renderItem = (item) => {
        return `<tbody>
              <tr>
                <th scope="row">${item.id}</th>
                <td>${item.name}</td>
                <td>${item.price}</td>
                <td>${item.size}</td>
                <td>${item.color}</td>
                <td><img src="${item.img}" alt="thuong-mai-dien-tu"></td>
                <td>${item.quantity}</td>
                <td class="description__td">${item.description_and_specs}</td>
                <td>${item.discount_percent}</td>
                <td>${item.category_id}</td>
                <td>${item.brand_id}</td>
                <td>
                <button class='btn btn-warning open-edit__btn me-1'><i class='bi bi-pen-fill'></i>Edit</button><button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#id-${item.id}'>delete<i class='bi bi-person-x-fill'></i></button><!-- Modal -->
                <div class='modal fade' id='id-${item.id}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Delete Category - ID: ${item.id}</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                        Are you sure delete this product?
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                        <button type='button' class='btn btn-primary delete__btn'data-bs-dismiss='modal' data-id=${item.id} data-name=${item.name}>Yes</button>
                      </div>
                    </div>
                  </div>
                </div>
                </td>
              </tr>
            </tbody>`;
    };
    const tableHeader = `<thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Size</th>
                            <th scope="col">Color</th>
                            <th scope="col">Image</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Description & Specs</th>
                            <th scope="col">Disc.</th>
                            <th scope="col">Category ID</th>
                            <th scope="col">Brand ID</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>`;

    const callAjax = (url, data, action) => {
        ajaxCallPOST(url, data, function(res) {
            if (Array.isArray(res)) {
                if (res.length === 0) {
                    return $('tbody').html(`<tr>
                <td colspan='10' align='center'><b>no product</b></td>
                </tr>`);
                }
                const array = res.map((item, index) => {
                    return renderItem(item);
                });
                $('table').html(`${tableHeader}${array.join('')}`);
                displayToast('success', action + ' ' + 'product success');
                $('input[name="name"]').val('');
                $('input[name="price"]').val('');
                $('input[name="size"]').val('');
                $('input[name="color"]').val('');
                $('input[name="img"]').val('');
                $('input[name="file"]').val('');
                $('textarea[name="description"]').val('');
                $('textarea[name="specs"]').val('');
                $('input[name="quantity"]').val('');
                $('select[name="category_id"]').val('');
                $('select[name="brand_id"]').val('');
            } else {
                // console.log(res);
                displayToast('error', res);
            }
            if (cancelBtn) {
                cancelBtn.click();

            }
            if (!loading.hasClass('d-none')) {
                loading.addClass('d-none');
            }
            if (switchBtn.prop('checked') === true) {
                switchBtn.click();
            }
        });
    }
    // delete
    $(document).on('click', '.btn.delete__btn', function() {
        let url = 'product/delete.php';
        const deleteForm = {
            id: $(this).data('id'),
            name: $(this).data('name'),
        };
        callAjax(url, deleteForm, 'delete');
    });

    // remove class invalid when focus input
    $('input').focus(function() {
        $(this).removeClass('invalid');
    })

    validateForm(
        function() {
            let data = '';
            let url = '';
            if (button.hasClass('add__btn')) {
                url = 'product/add.php';
            }
            if (button.hasClass('edit__btn')) {
                url = 'product/edit.php';
            }
            const formData = form.serialize();
            if (!switchBtn.prop('checked')) {
                loading.removeClass('d-none');
                let file = $('input[type="file"]')[0].files[0];
                let formUpload = new FormData();
                formUpload.append('file', file);
                formUpload.append('upload_preset', 'php_ecommerce');
                let uploadURL = 'https://api.cloudinary.com/v1_1/ninhnam/image/upload';
                ajaxCallUpload(uploadURL, formUpload, function(res) {
                    if (!res) {
                        loading.addClass('d-none');
                        return displayToast('error', 'upload image fail');
                        return;
                    }
                    data = formData + '&img=' + res.secure_url;
                    callAjax(url, data, url.split('/')[1].split('.')[0]);
                });
            } else {
                data = formData;
                callAjax(url, data, url.split('/')[1].split('.')[0]);
            }

        }
    )

});
</script>