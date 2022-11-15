<?php
include_once '../model/category.php';
?>
<style>
.table>tbody {
    vertical-align: unset;
}
</style>
<!-- category form -->
<form class="p-3" id='crud'>
    <h2>add category</h2>
    <input type="hidden" name="id">
    <div class="mb-3">
        <label for="category-name" class="form-label">Category name</label>
        <input type="text" class="form-control" id="category-name" placeholder="category name" name="name" required />
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
<!-- category LIST -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">name</th>
            <th scope="col">options</th>
        </tr>
    </thead>
    <tbody>
        <?php
$categories = get_all_category(); //result is a array
if ($categories) {
 foreach ($categories as $category) {
  echo '<tr>';
  echo "<th scope='row'>{$category['id']}</th>";
  echo "<td>{$category['name']}</td>";
  echo "<td><button class='btn btn-warning open-edit__btn me-1'><i class='bi bi-pen-fill'></i>Edit</button><button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#id-{$category['id']}'>delete<i class='bi bi-person-x-fill'></i></button><!-- Modal -->
            <div class='modal fade' id='id-{$category['id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Delete Category - ID: {$category['id']}</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                  </div>
                  <div class='modal-body'>
                    Are you sure delete this category?
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                    <button type='button' class='btn btn-primary delete__btn'data-bs-dismiss='modal' data-id={$category['id']} data-name={$category['name']}>Yes</button>
                  </div>
                </div>
              </div>
            </div></td>";
  echo '</tr>';
 }
} else {
 echo "<tr>
        <td colspan='3' align='center'><b>no category</b></td>
        </tr>";
}
?>

    </tbody>
</table>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const title = $('form > h2');
    const button = $('button[type="submit"].submit');
    const cancelBtn = $('input[type="reset"].cancel__btn');
    const loading = $('.loading');
    //cancel button handle click
    cancelBtn.click(function() {
        $(this).addClass('d-none');
        title.text('add category');
        button.addClass('add__btn')
        button.removeClass('edit__btn')
    })
    // edit btn handle click
    $(document).on('click', '.btn.open-edit__btn', function() {
        const grandfarther = $(this).parent().parent();
        const childrens = grandfarther.children();
        const array = Array.from(childrens);
        const cArray = array.map((item, index) => item.innerText)
        $('input[name="id"]').val(cArray[0])
        $('input[name="name"]').val(cArray[1])
        title.text('edit category - ID: ' + cArray[0])
        cancelBtn.removeClass('d-none');
        button.removeClass('add__btn')
        button.addClass('edit__btn')
    })
    const renderItem = (item) => {
        return `<tbody>
                  <tr>
                    <th scope="row">${item.id}</th>
                    <td>${item.name}</td>
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
                            Are you sure delete this category?
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
                </tbody>`
    }
    const tableHeader = `<thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">name</th>
                                <th scope="col">options</th>
                            </tr>
                        </thead>`

    // delete
    $(document).on('click', '.btn.delete__btn', function() {
        if (loading.hasClass('d-none')) {
            loading.removeClass('d-none');
        }
        let url = 'category/delete.php';
        const deleteForm = {
            id: $(this).data('id'),
            name: $(this).data('name'),
        }
        ajaxCallPOST(url, deleteForm, (res) => {
            if (Array.isArray(res)) {
                if (res.length === 0) {
                    return $('tbody').html(`<tr>
                    <td colspan='3' align='center'><b>no category</b></td>
                    </tr>`)
                }
                const array = res.map((item, index) => {
                    return renderItem(item)
                })
                $('table').html(
                    `${tableHeader}${array.join('')}`
                );
                displayToast('success', 'delete category success')
                $('input[name="name"]').val('');
            } else {
                // console.log(res);
                displayToast('error', res)
            }
            cancelBtn.click();
            if (!loading.hasClass('d-none')) {
                loading.addClass('d-none');
            }
        });
    })
    validateForm(
        function() {
            if (loading.hasClass('d-none')) {
                loading.removeClass('d-none');
            }
            //add
            if (button.hasClass('add__btn')) {
                console.log('add-form-send')
                var addform = $('form#crud').serialize();
                // console.log(addform);
                let url = 'category/add.php';
                ajaxCallPOST(url, addform, (res) => {
                    if (Array.isArray(res)) {
                        if (res.length === 0) {
                            return $('tbody').html(`<tr>
                    <td colspan='3' align='center'><b>no category</b></td>
                    </tr>`)
                        }
                        const array = res.map((item, index) => {
                            return renderItem(item)
                        })
                        $('table').html(
                            `${tableHeader}${array.join('')}`
                        );
                        displayToast('success', 'add category success')
                        $('input[name="name"]').val('');
                    } else {
                        // console.log(res);
                        displayToast('error', res)
                    }
                    if (!loading.hasClass('d-none')) {
                        loading.addClass('d-none');
                    }
                });
            }
            //edit
            if (button.hasClass('edit__btn')) {
                console.log('edit-form-send')
                var editForm = $('form#crud').serialize();
                // console.log(addform);
                let url = 'category/edit.php';
                ajaxCallPOST(url, editForm, (res) => {
                    if (Array.isArray(res)) {
                        if (res.length === 0) {
                            return $('tbody').html(`<tr>
                    <td colspan='3' align='center'><b>no category</b></td>
                    </tr>`)
                        }
                        const array = res.map((item, index) => {
                            return renderItem(item)
                        })
                        $('table').html(
                            `${tableHeader}${array.join('')}`
                        );
                        displayToast('success', 'edit category success')
                        $('input[name="name"]').val('');
                    } else {
                        // console.log(res);
                        displayToast('error', res)
                    }
                    cancelBtn.click();
                    if (!loading.hasClass('d-none')) {
                        loading.addClass('d-none');
                    }
                });
            }

        }
    )

})
</script>