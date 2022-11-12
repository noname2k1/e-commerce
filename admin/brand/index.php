<?php
include_once '../model/brand.php';
?>
<style>
.table>tbody {
    vertical-align: unset;
}
</style>
<!-- brand form -->
<form class="p-3" id='crud'>
    <h2>add brand</h2>
    <input type="hidden" name="id">
    <div class="mb-3">
        <label for="brand-name" class="form-label">brand name</label>
        <input type="text" class="form-control" id="brand-name" placeholder="brand name" name="name" required />
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
<!-- brand LIST -->
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
    $brands = get_all_brand(); //result is a array
    if ($brands) {
        foreach ($brands as $brand) {
            echo '<tr>';
            echo "<th scope='row'>{$brand['id']}</th>";
            echo "<td>{$brand['name']}</td>";
            echo "<td><button class='btn btn-warning open-edit__btn me-1'><i class='bi bi-pen-fill'></i>Edit</button><button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#id-{$brand['id']}'>delete<i class='bi bi-person-x-fill'></i></button><!-- Modal -->
            <div class='modal fade' id='id-{$brand['id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Delete Brand - ID: {$brand['id']}</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                  </div>
                  <div class='modal-body'>
                    Are you sure delete this brand?
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                    <button type='button' class='btn btn-primary delete__btn'data-bs-dismiss='modal' data-id={$brand['id']} data-name={$brand['name']}>Yes</button>
                  </div>
                </div>
              </div>
            </div></td>";
            echo '</tr>';
        }
    } else {
        echo "<tr>
        <td colspan='3' align='center'><b>no brand</b></td>
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
    //cancel button handle click
    cancelBtn.click(function() {
        $(this).addClass('d-none');
        title.text('add brand');
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
        title.text('edit brand - ID: ' + cArray[0])
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
                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Delete Brand - ID: ${item.id}</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                          </div>
                          <div class='modal-body'>
                            Are you sure delete this brand?
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
        let url = 'brand/delete.php';
        const deleteForm = {
            id: $(this).data('id'),
            name: $(this).data('name'),
        }
        ajaxCallPOST(url, deleteForm, (res) => {
            if (Array.isArray(res)) {
                if (res.length === 0) {
                    return $('tbody').html(`<tr>
                    <td colspan='3' align='center'><b>no brand</b></td>
                    </tr>`)
                }
                const array = res.map((item, index) => {
                    return renderItem(item)
                })
                $('table').html(
                    `${tableHeader}${array.join('')}`
                );
                displayToast('success', 'delete brand success')
                $('input[name="name"]').val('');
            } else {
                // console.log(res);
                displayToast('error', res)
            }
            cancelBtn.click();
        });
    })
    validateForm(
        function() {
            //add
            if (button.hasClass('add__btn')) {
                console.log('add-form-send')
                var addform = $('form#crud').serialize();
                // console.log(addform);
                let url = 'brand/add.php';
                ajaxCallPOST(url, addform, (res) => {
                    if (Array.isArray(res)) {
                        if (res.length === 0) {
                            return $('tbody').html(`<tr>
                    <td colspan='3' align='center'><b>no brand</b></td>
                    </tr>`)
                        }
                        const array = res.map((item, index) => {
                            return renderItem(item)
                        })
                        $('table').html(
                            `${tableHeader}${array.join('')}`
                        );
                        displayToast('success', 'add brand success')
                        $('input[name="name"]').val('');
                    } else {
                        // console.log(res);
                        displayToast('error', res)
                    }
                });
            }
            //edit
            if (button.hasClass('edit__btn')) {
                console.log('edit-form-send')
                var editForm = $('form#crud').serialize();
                // console.log(addform);
                let url = 'brand/edit.php';
                ajaxCallPOST(url, editForm, (res) => {
                    if (Array.isArray(res)) {
                        if (res.length === 0) {
                            return $('tbody').html(`<tr>
                    <td colspan='3' align='center'><b>no brand</b></td>
                    </tr>`)
                        }
                        const array = res.map((item, index) => {
                            return renderItem(item)
                        })
                        $('table').html(
                            `${tableHeader}${array.join('')}`
                        );
                        displayToast('success', 'edit brand success')
                        $('input[name="name"]').val('');
                    } else {
                        // console.log(res);
                        displayToast('error', res)
                    }
                    cancelBtn.click();
                });
            }
        }
    )




})
</script>