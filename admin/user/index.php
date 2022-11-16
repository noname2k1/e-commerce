<?php
include_once '../model/user.php';
?>
<style>
.table>tbody {
    vertical-align: unset;
}
</style>
<!-- user form -->
<form class="p-3" id='crud'>
    <h2>add user</h2>
    <input type="hidden" name="id">
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="username" aria-label="username" name="username"
                required />
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="password" aria-label="password" name="password"
                required />
        </div>
    </div>
    <div class="row mt-3 mb-3">
        <div class="col">
            <input type="email" class="form-control" id="email" placeholder="email" name="email" required />
        </div>
        <div class="col">
            <select class="form-select" id="" name="role">
                <option selected value="user">Choose role...</option>
                <?php
if (isset($_SESSION['role'])) {
 if ($_SESSION['role'] == 'admin') {
  echo '<option value="admin">admin</option>';
 }
}
echo ' <option value="user">user</option>';
echo ' <option value="mod">mod</option>';
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
<!-- USER LIST -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">username</th>
            <th scope="col">password</th>
            <th scope="col">email</th>
            <th scope="col">role</th>
            <th scope="col">options</th>
        </tr>
    </thead>
    <tbody>
        <?php
function fetch_all_user()
{
 if (isset($_SESSION['role'])) {
  if ($_SESSION['role'] == 'admin') {
   $query = 'select * from user';
  } else {
   $query = 'select * from user where role = "mod" or role = "user"';
  }
 }
 $user_data = pdo_fetch_all($query); //result is a array
 $me        = false;
 if ($user_data) {
  foreach ($user_data as $row) {
   if (isset($_SESSION['id'])) {
    $GLOBALS['id'] = $_SESSION['id'];
    if ($_SESSION['id'] == $row['id']) {
     $me = true;
    } else {
     $me = false;
    }
   }
   echo '<tr>';
   echo "<th scope='row'>{$row['id']}</th>";
   echo "<td>{$row['username']}";
   if ($me) {
    echo '<span class="badge bg-danger ms-1">me</span>';
   }
   echo "</td>";
   echo "<td>{$row['password']}</td>";
   echo "<td>{$row['email']}</td>";
   echo "<td>{$row['role']}</td>";
   echo "<td><button class='btn btn-warning open-edit__btn me-1'><i class='bi bi-pen-fill'></i>Edit</button><button class='btn btn-danger delete__btn' data-bs-toggle='modal' data-bs-target='#{$row['username']}-{$row['id']}'>delete<i class='bi bi-person-x-fill'></i></button><!-- Modal -->
            <div class='modal fade' id='{$row['username']}-{$row['id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Delete User - ID: {$row['id']}</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                  </div>
                  <div class='modal-body'>
                    Are you sure delete this user?
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                    <button type='button' class='btn btn-primary delete-user__btn'data-bs-dismiss='modal' data-id={$row['id']} data-username={$row['username']} data-password={$row['password']} data-role={$row['role']} data-email={$row['email']}>Yes</button>
                  </div>
                </div>
              </div>
            </div></td>";
   echo '</tr>';
  }
 } else {
  echo "<tr>
      <td colspan='6' align='center'><b>no user</b></td>
      </tr>";
 }
}
fetch_all_user();
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
        title.text('add user');
        button.addClass('add__btn')
        button.removeClass('edit__btn')
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
        $('input[name="id"]').val(cArray[0])
        $('input[name="username"]').val(cArray[1])
        $('input[name="password"]').val(cArray[2])
        $('input[name="email"]').val(cArray[3])
        $('select[name="role"]').val(cArray[4])
        title.text('edit user - ID: ' + cArray[0])
        cancelBtn.removeClass('d-none');
        button.removeClass('add__btn')
        button.addClass('edit__btn')
    })
    const renderItem = (item) => {
        const myId = <?php
echo $GLOBALS['id'];
?>;
        const me = myId == item.id ? '<span class="badge bg-danger ms-1">me</span>' : '';
        return `
                  <tr>
                    <th scope="row">${item.id}</th>
                    <td>${item.username}${me}</td>
                    <td>${item.password}</td>
                    <td>${item.email}</td>
                    <td>${item.role}</td>
                    <td>
                    <button class='btn btn-warning open-edit__btn me-1'><i class='bi bi-pen-fill'></i>Edit</button><button class='btn btn-danger delete__btn' data-bs-toggle='modal' data-bs-target='#${item.username}-${item.id}'>delete<i class='bi bi-person-x-fill'></i></button><!-- Modal -->
                    <div class='modal fade' id='${item.username}-${item.id}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Delete User - ID: ${item.id}</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                          </div>
                          <div class='modal-body'>
                            Are you sure delete this user?
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                            <button type='button' class='btn btn-primary delete-user__btn'data-bs-dismiss='modal' data-id=${item.id} data-username=${item.username} data-password=${item.password} data-email=${item.email} data-role=${item.role}>Yes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    </td>
                  </tr>
                `
    }
    const tableHeader = `<thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>`

    const callAjax = (url, data, action) => {
        if (loading.hasClass('d-none')) {
            loading.removeClass('d-none');
        }
        ajaxCallPOST(url, data, function(res) {
            if (Array.isArray(res)) {
                if (res.length === 0) {
                    return $('tbody').html(`<tr>
                <td colspan='6' align='center'><b>no user</b></td>
                </tr>`);
                }
                const array = res.map((item, index) => {
                    return renderItem(item);
                });
                console.log(array)
                $('table').html(`${tableHeader}${array.join('')}`);
                displayToast('success', action + ' ' + 'user success');
                $('input[name="username"]').val('');
                $('input[name="email"]').val('');
                $('input[name="password"]').val('');
                $('select[name="role"]').val('user');
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
        });
    }
    // delete user
    $(document).on('click', '.btn.delete-user__btn', function() {
        let url = 'user/delete.php';
        const deleteForm = {
            id: $(this).data('id'),
            username: $(this).data('username'),
            password: $(this).data('password'),
            email: $(this).data('email'),
            role: $(this).data('role')
        }
        callAjax(url, deleteForm, 'delete');
    })
    // remove class invalid when focus input
    $('input').focus(function() {
        $(this).removeClass('invalid');
    })
    // pass logic after form submit as a callback paramenter of validateForm function
    validateForm(
        //callback
        function() {
            const data = $('form#crud').serialize();
            let url = '';
            if (button.hasClass('add__btn')) {
                //add user
                url = 'user/add.php';
            } else {
                //edit user
                url = 'user/edit.php';
            }
            callAjax(url, data, url.split('/')[1].split('.')[0]);
        }
    );
})
</script>