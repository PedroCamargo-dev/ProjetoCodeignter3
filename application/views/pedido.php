<div class="container">
    <div class="card">
        <h5 class="card-header">Dados do pedido</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title">Colaborador <h5 class="fw-light"><?php echo $users[0]->firstName ?></h5>
                    </h4>
                </div>
                <div class="col-md-6 mb-4">
                    <p class="card-text text-end fs-5">
                        <i class="bi bi-calendar2-minus"></i> <?php echo date("d/m/Y"); ?><br>
                        <i class="bi bi-clock"></i> <?php echo date("H:i:s"); ?><br>
                        <i class="bi bi-cash-coin" id="totalProducts"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <h5 class="card-header">Item do Pedido</h5>
        <div class="card-body">
            <form id="itensPedido">
                <div class="row g-3">
                    <div class="col-md-7">
                        <select class="form-select" aria-label="Product" id="product">
                            <option value="">Select a product </option>
                            <?php foreach ($products as $product) : ?>
                                <option value="<?php echo $product->idProduct ?>"><?php echo $product->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md">
                        <input type="text" class="form-control" id="value" placeholder="Value" aria-label="Value" readonly>
                    </div>
                    <div class="col-md">
                        <input type="number" class="form-control" id="amount" placeholder="Amount" aria-label="Amount">
                    </div>
                    <div class="col-md-1 mx-auto">
                        <button type="button" id="addProduct" class="btn btn-outline-info">Inserir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <h5 class="card-header">Lista de pedidos</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col-1">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Value</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-danger" id="clearTable">Limpar</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#clearTable").click(function() {
            $("tbody").empty();
        });

        $("#addProduct").click(function() {
            if ($('#product option:selected').val() > 0) {
                var TotalValue = 0;
                var idProduct = $('#product option:selected').val();
                var product = $("#product option:selected").text();
                var value = $("#value").val();
                var valueReplace = $("#value").val().replace("R$", "").replace(".", "").replace(",", ".");
                var amount = $("#amount").val();
                var subtotal = valueReplace * amount;
                var markup = "<tr><td>" + idProduct + "</td><td>" + product + "</td><td>" + value + "</td><td>" + amount + "</td><td id='loop' hidden>" + subtotal + "</td><td>" + new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }).format(subtotal) + "</td><td><button onclick='delRow(this , " + subtotal + " )' class='remover btn btn-sm btn-outline-danger'><i class='bi bi-trash'></i></i></button></td></tr>";
                $("table tbody").append(markup);

                $('div').find('#product').val('');
                $('div').find('#value').val('');
                $('div').find('#amount').val('');
                $("tr #loop").each(function(index, value) {
                    currentRow = parseFloat($(this).text());
                    TotalValue += currentRow
                });
                var valueTotal = TotalValue.toFixed(2);
                $("#totalProducts").text(valueTotal);
            }
        });
    });

    function delRow(row, TotalValue) {
        $(row).closest('tr').remove();
        document.getElementById('totalProducts').innerHTML -= TotalValue;
    }

    $(document).on("change", "#product", function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?php base_url() ?>listProducts",
            type: "POST",
            dataType: "json",
            data: {
                codigo: $('#product option:selected').val()
            },
            success: function(data) {
                if (data.response == "success") {
                    $("#value").val(data.product.value).maskMoney({
                        showSymbol: true,
                        prefix: 'R$ ',
                        allowNegative: true,
                        selectAllOnFocus: true,
                        thousands: '.',
                        decimal: ',',
                        affixesStay: false
                    }).maskMoney("mask");
                    $("#amount").val('1');
                } else {
                    toastr["error"](data.message);
                }
            }
        });
    });
</script>