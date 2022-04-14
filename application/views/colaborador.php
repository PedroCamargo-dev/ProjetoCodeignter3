<div class="container col-10 card p-2">
    <div class="col-md-12 m-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cadColaborador">
            Novo Colaborador
        </button>

        <!-- Modal cadastro -->
        <div class="modal fade" id="cadColaborador" tabindex="-1" aria-labelledby="cadColaboradorLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadColaboradorLabel">Adicionar Colaborador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 p-2 needs-validation" id="form" novalidate method="POST" action="">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" name="firstName" class="form-control" id="firstName" placeholder="Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4" class="form-label">Username</label>
                                <input type="text" name="userName" class="form-control" id="userName" placeholder="Username" required>
                            </div>
                            <div class="col-md-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="none@none.com" required>
                            </div>
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="(99) 99999-9999" required>
                            </div>
                            <div class="col-md-4">
                                <label for="idFunction" class="form-label">Function</label>
                                <select id="idFunction" name="idFunction" class="form-select" required>
                                    <option value="" selected>Choose...</option>
                                    <?php foreach ($functions as $function) : ?>
                                        <option value="<?php echo $function->idFunction; ?>"><?php echo $function->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="add">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal cadastro -->
        <!-- Modal edit -->
        <div class="modal fade" id="editColaborador" tabindex="-1" aria-labelledby="editColaboradorLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editColaboradorLabel">Editar Colaborador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 p-2 needs-validation" id="editForm" novalidate method="POST" action="">
                            <input type="hidden" id="idUser" name="idUser" value="">
                            <div class="col-md-4">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" name="editFirstName" class="form-control" id="editFirstName" placeholder="Name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" name="editLastName" class="form-control" id="editLastName" placeholder="Last Name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4" class="form-label">Username</label>
                                <input type="text" name="editUserName" class="form-control" id="editUserName" placeholder="Username" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="editEmail" class="form-control" id="editEmail" placeholder="none@none.com" required>
                            </div>
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="editPhone" class="form-control" id="editPhone" placeholder="(99) 99999-9999" required>
                            </div>
                            <div class="col-md-4">
                                <label for="idFunction" class="form-label">Function</label>
                                <select id="editIdFunction" name="editIdFunction" class="form-select" required>
                                    <option value="" selected>Choose...</option>
                                    <?php foreach ($functions as $function) : ?>
                                        <option value="<?php echo $function->idFunction; ?>"><?php echo $function->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="update">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal edit -->
    </div>
    <table id="listUsers" class="table table-striped table-responsive" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Function</th>
                <th>Username</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    //create user
    $(document).on("click", "#add", function(e) {
        e.preventDefault();

        var idFunction = $('#idFunction').val();
        var userName = $('#userName').val();
        var firstName = $('#firstName').val();
        var lastName = $('#lastName').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var phone = $('#phone').val();

        if (idFunction == "" || userName == "" || firstName == "" || lastName == "" || email == "" || password == "" || phone == "") {
            alert('There are empty fields');
        } else {
            $.ajax({
                url: "<?php base_url() ?>cadColaborador",
                type: "POST",
                dataType: "json",
                data: {
                    idFunction: idFunction,
                    userName: userName,
                    firstName: firstName,
                    lastName: lastName,
                    email: email,
                    password: password,
                    phone: phone
                },
                success: function(data) {
                    if (data.response == "success") {
                        $('#listUsers').DataTable().destroy();
                        listColaborador();
                        $("#cadColaborador").modal("hide")
                        toastr["success"](data.message)
                        $('#form')[0].reset();
                    } else {
                        toastr["error"](data.message)
                    }
                }
            });
        }
    });

    //datatable users list

    function listColaborador() {
        $.ajax({
            url: "<?php base_url() ?>listColaborador",
            type: "POST",
            dataType: "json",
            success: function(data) {
                $('#listUsers').DataTable({
                    "data": data.users,
                    "responsive": true,
                    dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "columns": [{
                            "data": "idUser"
                        },
                        {
                            "data": "name"
                        },
                        {
                            "data": "userName"
                        },
                        {
                            "data": "firstName"
                        },
                        {
                            "data": "lastName"
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "phone"
                        },
                        {
                            data: null,
                            "render": function(data, type, row, meta) {
                                var a = `
                                    <a href="#" value="${row.idUser}" id="del" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></i></a>
                                    <a href="#" value="${row.idUser}" id="edit" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#editColaborador"><i class="bi bi-pencil-square"></i></a>
                            `;
                                return a;
                            }
                        }
                    ]
                });
            }
        });
    }
    listColaborador();

    //disable/del user

    $(document).on("click", "#del", function(e) {
        e.preventDefault();

        var del_id = $(this).attr("value");

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php base_url() ?>delColaborador",
                    type: "POST",
                    dataType: "json",
                    data: {
                        del_id: del_id
                    },
                    success: function(data) {
                        if (data.response == "success") {
                            $('#listUsers').DataTable().destroy();
                            listColaborador();
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Your imaginary file is safe :)',
                                'error'
                            );
                        }

                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        });
    });

    //edit user

    $(document).on("click", "#edit", function(e) {
        e.preventDefault();

        var edit_id = $(this).attr("value");

        $.ajax({
            url: "<?php base_url(); ?>editColaborador",
            type: "post",
            dataType: "json",
            data: {
                edit_id: edit_id
            },
            success: function(data) {
                if (data.response == "success") {
                    $('#editColaborador').modal('show');
                    $("#idUser").val(data.user.idUser);
                    $("#editFirstName").val(data.user.firstName);
                    $("#editLastName").val(data.user.lastName);
                    $("#editUserName").val(data.user.userName);
                    $("#editEmail").val(data.user.email);
                    $("#editPhone").val(data.user.phone);
                    $("#editIdFunction").val(data.user.idFunction);
                } else {
                    toastr["error"](data.message);
                }
            }
        });
    });

    $(document).on("click", "#update", function(e) {
        e.preventDefault();

        var idUser = $("#idUser").val();
        var editFirstName = $("#editFirstName").val();
        var editLastName = $("#editLastName").val()
        var editUserName = $("#editUserName").val()
        var editEmail = $("#editEmail").val()
        var editPhone = $("#editPhone").val()
        var editIdFunction = $("#editIdFunction").val()

        if (editFirstName == "" || editLastName == "" || editUserName == "" || editEmail == "" || editPhone == "" || editIdFunction == "") {
            alert('There are empty fields');
        } else {
            $.ajax({
                url: "<?php base_url(); ?>updateColaborador",
                type: "post",
                dataType: "json",
                data: {
                    idUser: idUser,
                    editFirstName: editFirstName,
                    editLastName: editLastName,
                    editUserName: editUserName,
                    editEmail: editEmail,
                    editPhone: editPhone,
                    editIdFunction: editIdFunction
                },
                success: function(data) {
                    if (data.response == "success") {
                        $('#listUsers').DataTable().destroy();
                        listColaborador();
                        $('#editColaborador').modal('hide');
                        toastr["success"](data.message);
                    } else {
                        toastr["error"](data.message);
                    }
                }
            });

        }
    });
</script>