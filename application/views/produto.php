<div class="container col-10 card p-2">
    <div class="col-md-12 m-3">
        <!-- Botão modal -->
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cadProduto">
            Novo Produto
        </button>

        <!-- Modal cadastro -->
        <div class="modal fade" id="cadProduto" tabindex="-1" aria-labelledby="cadProdutoLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadProdutoLabel">Adicionar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 p-2 needs-validation" id="form" novalidate method="POST" action="">
                            <input type="hidden" name="idUser" id="idUser" value="<?php echo $users[0]->idUser; ?>">
                            <div class="col-md-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="Value" class="form-label">Value</label>
                                <input type="text" class="form-control" placeholder="Value" data-symbol="R$ " data-thousands="." data-decimal="," id="value" name="value" data-type="currency" required>
                            </div>
                            <div class="col-md-4">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount" required>
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" required></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="add">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal cadastro
        
        
        
        Modal edit -->
        <div class="modal fade" id="editProduto" tabindex="-1" aria-labelledby="editProdutoLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProdutoLabel">Editar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 p-2 needs-validation" id="form" novalidate method="POST" action="">
                            <input type="hidden" name="idUser" id="idUser" value="">
                            <input type="hidden" id="idProduct" name="idProduct" value="">
                            <div class="col-md-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="editName" class="form-control" id="editName" placeholder="Name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="Value" class="form-label">Value</label>
                                <input type="text" class="form-control" placeholder="Value" data-symbol="R$ " data-thousands="." data-decimal="," id="editValue" name="editValue" data-type="currency" required>
                            </div>
                            <div class="col-md-4">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" name="editAmount" class="form-control" id="editAmount" placeholder="Amount" required>
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="editDescription" style="font-size: 13px;" id="editDescription" rows="6" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="update">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal edit -->
    </div>
    <table id="listProducts" class="table table-striped table-responsive" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Value</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    $(function() {
        $("#value").maskMoney({
            prefix: 'R$ ',
            allowNegative: true,
            selectAllOnFocus: true,
            thousands: ',',
            decimal: '.',
            affixesStay: false
        });
        $("#editValue").maskMoney({
            prefix: 'R$ ',
            allowNegative: true,
            selectAllOnFocus: true,
            thousands: ',',
            decimal: '.',
            affixesStay: false
        });
    })

    //create product
    $(document).on("click", "#add", function(e) {
        e.preventDefault();

        var idUser = $('#idUser').val();
        var name = $('#name').val();
        var value = $('#value').maskMoney({
            prefix: 'R$ ',
            allowNegative: true,
            selectAllOnFocus: true,
            thousands: ',',
            decimal: '.',
            affixesStay: false
        }).val();
        var valueReplace = $('#value').maskMoney('unmasked')[0];
        var amount = $('#amount').val();
        var description = $('#description').val();

        if (idUser == "" || name == "" || valueReplace == "" || amount == "" || description == "") {
            alert('There are empty fields');
        } else {
            $.ajax({
                url: "<?php base_url() ?>cadProduto",
                type: "POST",
                dataType: "json",
                data: {
                    idUser: idUser,
                    name: name,
                    value: valueReplace,
                    amount: amount,
                    description: description
                },
                success: function(data) {
                    if (data.response == "success") {
                        $('#listProducts').DataTable().destroy();
                        listProdutos();
                        $("#cadProduto").modal("hide")
                        toastr["success"](data.message)
                        $('#form')[0].reset();
                    } else {
                        toastr["error"](data.message)
                    }
                }
            });
        }
    })

    //datatable products list
    function listProdutos() {
        $.ajax({
            url: "<?php base_url() ?>listProdutos",
            type: "POST",
            dataType: "json",
            success: function(data) {
                $('#listProducts').DataTable({
                    "data": data.products,
                    "responsive": true,
                    dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "columns": [{
                            "data": "idProduct"
                        },
                        {
                            "data": "name"
                        },
                        {
                            "data": "value",
                            render: $.fn.dataTable.render.number('.', ',', 2, 'R$').display
                        },
                        {
                            "data": "amount"
                        },
                        {
                            "data": "description",
                            render: function(data, type, row) {
                                return data.length > 150 ?
                                    data.substr(0, 150) + '…' :
                                    data;
                            }
                        },
                        {
                            data: null,
                            "render": function(data, type, row, meta) {
                                var a = `
                                    <a href="#" value="${row.idProduct}" id="del" name="del" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></i></a>
                                    <a href="#" value="${row.idProduct}" id="edit" name="edit" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#editProduto"><i class="bi bi-pencil-square"></i></a>
                            `;
                                return a;
                            }
                        }
                    ]
                });
            }
        });
    }
    listProdutos();

    //"del" product
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
                    url: "<?php base_url() ?>delProduto",
                    type: "POST",
                    dataType: "json",
                    data: {
                        del_id: del_id
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.response == "success") {
                            $('#listProducts').DataTable().destroy();
                            listProdutos();
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

    //edit product
    $(document).on("click", "#edit", function(e) {
        e.preventDefault();

        var edit_id = $(this).attr("value");

        $.ajax({
            url: "<?php base_url(); ?>editProduto",
            type: "post",
            dataType: "json",
            data: {
                edit_id: edit_id
            },
            success: function(data) {
                if (data.response == "success") {
                    $('#editProduto').modal('show');
                    $("#idProduct").val(data.product.idProduct);
                    $("#editName").val(data.product.name);
                    $("#editValue").val(data.product.value);
                    $("#editAmount").val(data.product.amount);
                    $("#editDescription").val(data.product.description);
                } else {
                    toastr["error"](data.message);
                }
            }
        });
    });

    $(document).on("click", "#update", function(e) {
        e.preventDefault();

        var idProduct = $('#idProduct').val();
        var editName = $('#editName').val();
        var editValue = $('#editValue').maskMoney({
            prefix: 'R$ ',
            allowNegative: true,
            selectAllOnFocus: true,
            thousands: ',',
            decimal: '.',
            affixesStay: false
        }).val();
        var editValueReplace = $('#editValue').maskMoney('unmasked')[0];
        var editAmount = $('#editAmount').val();
        var editDescription = $('#editDescription').val();

        if (editName == "" || editValueReplace == "" || editAmount == "" || editDescription == "") {
            alert('There are empty fields');
        } else {
            $.ajax({
                url: "<?php base_url(); ?>updateProduto",
                type: "post",
                dataType: "json",
                data: {
                    idProduct: idProduct,
                    editName: editName,
                    editValue: editValueReplace,
                    editAmount: editAmount,
                    editDescription: editDescription
                },
                success: function(data) {
                    if (data.response == "success") {
                        $('#listProducts').DataTable().destroy();
                        listProdutos();
                        $('#editProduto').modal("hide");
                        toastr["success"](data.message);
                    } else {
                        toastr["error"](data.message);
                    }
                }
            });

        }
    });
</script>