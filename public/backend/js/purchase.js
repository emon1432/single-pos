//sidebar hide and show
$(document).ready(function () {
    $(".vertical-layout").addClass("toggle-menu");
});

//get product by supplier select
$("select[name='supplier_id']").change(function () {
    var supplier_id = $(this).val();
    if (supplier_id) {
        $.ajax({
            url: "/get/product-by-supplier/" + supplier_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                // console.log(data);
                var d = $('select[name="product_id"]').empty();

                $('select[name="product_id"]').append(
                    '<option selected disabled value="">Select ...</option>'
                );

                $.each(data, function (key, value) {
                    $('select[name="product_id"]').append(
                        '<option data-unit_quantity_in_stock="' +
                            value.unit_quantity_in_stock +
                            '" data-subunit_quantity_in_stock="' +
                            value.subunit_quantity_in_stock +
                            '"data-unit_id="' +
                            value.unit.id +
                            '"data-subunit_exits="' +
                            value.unit.related_unit +
                            '" value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    } else {
        $("select[name='product_id']").empty();
    }
});

//addRow button click
$(document).on("click", ".addRow", function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName("needs-validation");
    // Loop over them and prevent submission if it was validated successfully do not submit the form
    var validation = Array.prototype.filter.call(forms, function (form) {
        // console.log(form);
        form.addEventListener(
            "submit",
            function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                if (form.checkValidity() === true) {
                    event.preventDefault();
                }
                form.classList.add("was-validated");
            },
            false
        );
    });

    //find all the input fields
    var product_id = $("select[name='product_id']").val();
    var product_name = $("select[name='product_id'] option:selected").text();
    var unit_id = $("select[name='product_id'] option:selected").data(
        "unit_id"
    );
    var unit_quantity_in_stock = $(
        "select[name='product_id'] option:selected"
    ).data("unit_quantity_in_stock");
    var subunit_quantity_in_stock = $(
        "select[name='product_id'] option:selected"
    ).data("subunit_quantity_in_stock");
    var subunit_exits = $("select[name='product_id'] option:selected").data(
        "subunit_exits"
    );
    //check if the product is already added
    // console.log([product_id, product_name]);
    var check = 0;
    $("tbody tr").each(function () {
        var row_product_id = $(this).find("input[name='product_id[]']").val();
        if (product_id == row_product_id) {
            check = 1;
        }
    });
    if (check == 1) {
        iziToast.warning({
            title: "Product already added",
            position: "topRight",
        });
    } else {
        if (forms[0].checkValidity() === true) {
            addRow();
            calculate_buying_price();
            estimatedAmount();
            tFootShowHide();

            $("tbody tr:last")
                .find("input[name='product_id[]']")
                .val(product_id);

            $("tbody tr:last")
                .find("input[name='product_name[]']")
                .val(product_name);

            $("tbody tr:last").find("input[name='unit_id[]']").val(unit_id);

            $("tbody tr:last")
                .find("input[name='current_unit_quantity_in_stock[]']")
                .val(unit_quantity_in_stock);
            if (subunit_exits != null) {
                $("tbody tr:last")
                    .find("input[name='current_subunit_quantity_in_stock[]']")
                    .val(subunit_quantity_in_stock);
            } else {
                $("tbody tr:last")
                    .find("input[name='current_subunit_quantity_in_stock[]']")
                    .attr("type", "hidden");

                $("tbody tr:last")
                    .find("input[name='subunit_quantity[]']")
                    .attr("type", "hidden");

                $("tbody tr:last")
                    .find("input[name='subunit_price[]']")
                    .attr("type", "hidden");
            }
        }
    }
});

//removeRow Button
$(document).on("click", ".removeRow", function () {
    $(this).closest("tr").remove();
    estimatedAmount();
    tFootShowHide();
});

//if supplier is changed
$("select[name='supplier_id']").change(function () {
    //reset tbody
    $("tbody").html("");
    tFootShowHide();
});

//calculate buying price on keyup and change and sum up the buying price
$(document).on(
    "keyup change",
    "input[name='unit_quantity[]'], input[name='subunit_quantity[]'], input[name='unit_price[]'], input[name='subunit_price[]']",
    function () {
        var unit_quantity = $(this)
            .closest("tr")
            .find("input[name='unit_quantity[]']")
            .val();
        var subunit_quantity = $(this)
            .closest("tr")
            .find("input[name='subunit_quantity[]']")
            .val();
        var unit_price = $(this)
            .closest("tr")
            .find("input[name='unit_price[]']")
            .val();
        var subunit_price = $(this)
            .closest("tr")
            .find("input[name='subunit_price[]']")
            .val();
        var total_price =
            unit_quantity * unit_price + subunit_quantity * subunit_price;
        $(this)
            .closest("tr")
            .find("input[name='total_price[]']")
            .val(total_price);
        estimatedAmount();
    }
);

//calculate total amount with order tax is percentage shipping charge,others charge and discount on keyup and change
$(document).on(
    "keyup change",
    "input[name='order_tax'],input[name='shipping_charge'],input[name='others_charge'],input[name='discount_amount']",
    function () {
        totalAmount();
    }
);

//if payment method is not cash then show paid amount field
$("select[name='payment_method_id']").change(function () {
    var payment_method = $(this).val();
    if (payment_method == "1") {
        $(".payment_reference").hide();
    } else {
        $(".payment_reference").show();
    }
});

//paid_amount on keyup and change
$(document).on("keyup change", "input[name='paid_amount']", function () {
    due_calculation();
});

//submit_button
$(document).on("click", ".submit_button", function () {
    //get all buying price value and check if any value is 0

    var total_price = $("input[name='total_price[]']")
        .map(function () {
            return $(this).val();
        })
        .get();

    //check note is empty or not input[name='note']
    var note = $("input[name='note']").val();
    if (note == "") {
        iziToast.warning({
            title: "Please enter note",
            position: "topRight",
        });
        return false;
    }

    var buying_price_zero = $.inArray("0", total_price);

    if (buying_price_zero != -1) {
        iziToast.warning({
            title: "Buying price can't be 0",
            position: "topRight",
        });
        //and mark that row

        $("input[name='total_price[]']")
            .eq(buying_price_zero)
            .closest("tr")
            .css("background-color", "#f7b6b6");
        //and if any row is marked then remove that mark when user change the value

        $(document).on(
            "keyup change",
            "input[name='unit_quantity[]'], input[name='subunit_quantity[]'], input[name='unit_price[]'], input[name='subunit_price[]']",
            function () {
                $(this).closest("tr").css("background-color", "");
            }
        );
    } else {
        //submit purchaseForm

        $("#purchaseForm").submit();
    }
});

//reset_button
$(document).on("click", ".reset_button", function () {
    $("tbody").html("");
    tFootShowHide();
});

//table footer show hide function
function tFootShowHide() {
    if ($("tbody tr").length == 0) {
        $("tfoot").hide();

        $(".submitAndReset").hide();
    } else {
        $("tfoot").show();

        $(".submitAndReset").show();
        estimatedAmount();
    }
}

//addRow function
function addRow() {
    var tr =
        "<tr>" +
        '<td><input type="hidden" name="product_id[]" value=""><input type="text" name="product_name[]" value="" class="form-control" readonly></td>' +
        '<td><input type="hidden" name="unit_id[]" value=""><input type="text" name="current_unit_quantity_in_stock[]" value="" class="form-control" readonly></td>' +
        '<td><input type="text" name="current_subunit_quantity_in_stock[]" value="" class="form-control" readonly></td>' +
        '<td><input type="text" step="any" name="unit_quantity[]" value="0" min="0" class="form-control" required></td>' +
        '<td><input type="text" step="any" name="subunit_quantity[]" value="0" min="0" class="form-control" required></td>' +
        '<td><input type="text" step="any" name="unit_price[]" value="0" min="0" class="form-control" required></td>' +
        '<td><input type="text" step="any" name="subunit_price[]" value="0" min="0" class="form-control" required></td>' +
        '<td><input type="text" name="total_price[]" value="0" min="1" class="form-control" readonly></td>' +
        '<td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="feather icon-trash"></i></button></td>' +
        "</tr>";

    $("tbody").append(tr);
}

//calculate buying price
function calculate_buying_price() {
    var unit_quantity = parseFloat(
        $("tbody tr:last").find("input[name='unit_quantity[]']").val()
    );
    var subunit_quantity = parseFloat(
        $("tbody tr:last").find("input[name='subunit_quantity[]']").val()
    );
    var unit_price = parseFloat(
        $("tbody tr:last").find("input[name='unit_price[]']").val()
    );
    var subunit_price = parseFloat(
        $("tbody tr:last").find("input[name='subunit_price[]']").val()
    );
    var total_price =
        unit_quantity * unit_price + subunit_quantity * subunit_price;
    $("tbody tr:last").find("input[name='total_price[]']").val(total_price);
}

//estimatedAmount function
function estimatedAmount() {
    var sum = 0;

    $("input[name='total_price[]']").each(function () {
        var value = $(this).val();
        if (!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
        }
    });
    $("input[name='estimated_amount']").val(sum);
    totalAmount();
    due_calculation();
}

//due calculation
function due_calculation() {
    var total_amount = parseFloat($("input[name='total_amount']").val());

    var paid_amount = parseFloat($("input[name='paid_amount']").val());

    var due_amount = $("input[name='due_amount']").val();

    due_amount = total_amount - paid_amount;

    $("input[name='due_amount']").val(due_amount);
}

//total amount calculation
function totalAmount() {
    var order_tax = parseFloat($("input[name='order_tax']").val());

    var shipping_charge = parseFloat($("input[name='shipping_charge']").val());

    var others_charge = parseFloat($("input[name='others_charge']").val());

    var discount_amount = parseFloat($("input[name='discount_amount']").val());
    var estimated_amount = parseFloat(
        $("input[name='estimated_amount']").val()
    );
    order_tax = estimated_amount * (order_tax / 100);

    var total_amount =
        estimated_amount +
        order_tax +
        shipping_charge +
        others_charge -
        discount_amount;

    $("input[name='total_amount']").val(total_amount);
    //set max value for paid amount

    $("input[name='paid_amount']").attr("max", total_amount);
    //set max value for due amount

    $("input[name='due_amount']").attr("max", total_amount);

    var due = $("input[name='due_amount']").val();

    $("input[name='paid_amount']").val(total_amount - due);
}
