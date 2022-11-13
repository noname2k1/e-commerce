<?php
include_once '../model/utils.php';
?>
<style>
.table>tbody {
    vertical-align: unset;
}
</style>
<!-- profile form -->
<form class="p-3 fixed-bottom d-none bg-light" id='crud'>
    <h2> edit profile</h2>
    <input type="hidden" name="id">
    <input type="hidden" class="form-control" name='userid' />
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="name" aria-label="name" name="name" required />
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="phone" aria-label="phone" name="phone" required />
        </div>
    </div>
    <div class="row mt-3 mb-3">
        <div class="col">
            <input type="file" class="form-control file d-none" placeholder="img" aria-label="img" name="file" disabled
                required />
            <input class="form-control img-link" type="text" name='img' placeholder="img" required>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">img-link / file</label>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary edit__btn submit">Submit</button>
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
<!-- profile LIST -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">name</th>
            <th scope="col">img</th>
            <th scope="col">createdAt</th>
            <th scope="col">updatedAt</th>
            <th scope="col">phone</th>
            <th scope="col">userid</th>
            <th scope="col">options</th>
        </tr>
    </thead>
    <tbody>
        <?php
    if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        $query = 'select * from profile';
    } else {
        $query = "select * from profile inner join user on profile.userid = user.id where user.role = 'mod' or user.role = 'user'";
    }
    $data= pdo_fetch_all($query); //result is a array
    $me = false;
    if ($data) {
        foreach ($data as $row) {
            if ($row['userid'] == $_SESSION['id']) {
                $me = true;
            } else
                $me = false;
            echo '<tr>';
            echo "<th scope='row'>{$row['id']}</th>";
            echo "<td>{$row['name']}";
            if($me) {
                echo "<span class='badge bg-danger ms-1'>me</span>";
            }
            echo "</td>";
            echo "<td><img src='{$row['img']}' alt='thuong-mai-dien-tu'></td>";
            echo "<td>{$row['createdAt']}</td>";
            echo "<td>{$row['updatedAt']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['userid']}</td>";
            echo "<td><button class='btn btn-warning open-edit__btn me-1'><i class='bi bi-pen-fill'></i>Edit</button></td>";
            echo '</tr>';
        }
    } else {
      echo "<tr>
      <td colspan='3' align='center'><b>no profile</b></td>
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
    const form = $('form#crud');
    //cancel button handle click
    cancelBtn.click(function() {
        title.text('edit profile')
        $(this).addClass('d-none');
        button.addClass('add__btn')
        button.removeClass('edit__btn')
        form.addClass('d-none')
    })
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
                    return item.innerText.slice(0, item.children[0].innerText.length * -1);
                }
            }
            return item.innerText
        });
        // console.log(cArray);
        $('input[name="id"]').val(cArray[0])
        $('input[name="name"]').val(cArray[1])
        $('input[name="img"]').val(cArray[2].getAttribute('src'))
        $('input[name="phone"]').val(cArray[5])
        $('input[name="userid"]').val(cArray[6])
        title.text('edit profile - ID: ' + cArray[0])
        form.removeClass('d-none')
        button.removeClass('add__btn')
        button.addClass('edit__btn')
        cancelBtn.removeClass('d-none');
    })

    const switchBtn = $('input[type="checkbox"].form-check-input');
    const fileInput = $('input[type="file"].form-control.file');
    const textInput = $('input[type="text"].img-link');
    switchBtn.change(function() {
        if (switchBtn.prop('checked')) {
            fileInput.prop('disabled', false);
            textInput.prop('disabled', true);
            fileInput.removeClass('d-none');
            textInput.addClass('d-none');
        } else {
            fileInput.prop('disabled', true);
            textInput.prop('disabled', false);
            fileInput.addClass('d-none');
            textInput.removeClass('d-none');
        }
    });

    const renderItem = (item) => {
        return `<tbody>
                  <tr>
                    <td scope="col">${item.id}</td>
                    <td scope="col">${item.name}</td>
                    <td scope="col"><img src="${item.img}" alt="thuong-mai-dien-tu" /></td>
                    <td scope="col">${item.createdAt}</td>
                    <td scope="col">${item.updatedAt}</td>
                    <td scope="col">${item.phone}</td>
                    <td scope="col">${item.userid}</td>
                    <td>
                    <button class='btn btn-warning open-edit__btn me-1'><i class='bi bi-pen-fill'></i>Edit</button>
                    </td>
                  </tr>
                </tbody>`
    }
    const tableHeader = `<thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">name</th>
                                <th scope="col">img</th>
                                <th scope="col">createdAt</th>
                                <th scope="col">updatedAt</th>
                                <th scope="col">phone</th>
                                <th scope="col">userid</th>
                                <th scope="col">options</th>
                            </tr>
                        </thead>`

    validateForm(
        function() {
            //edit
            if (button.hasClass('edit__btn')) {
                console.log('edit-form-send')
                var editForm = $('form#crud').serialize();
                let url = 'profile/edit.php';
                ajaxCallPOST(url, editForm, (res) => {
                    if (Array.isArray(res)) {
                        if (res.length === 0) {
                            return $('tbody').html(`<tr>
                    <td colspan='3' align='center'><b>no profile</b></td>
                    </tr>`)
                        }
                        const array = res.map((item, index) => {
                            return renderItem(item)
                        })
                        $('table').html(
                            `${tableHeader}${array.join('')}`
                        );
                        displayToast('success', 'edit profile success')
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