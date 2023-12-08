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
                console.log(data);
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
                            '" data-category_id="' +
                            value.category_id +
                            '" data-category_name="' +
                            value.category.name +
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
    var category_id = $("select[name='product_id'] option:selected").data(
        "category_id"
    );
    var category_name = $("select[name='product_id'] option:selected").data(
        "category_name"
    );
    var product_id = $("select[name='product_id']").val();
    var product_name = $("select[name='product_id'] option:selected").text();
    var unit_quantity_in_stock = $(
        "select[name='product_id'] option:selected"
    ).data("unit_quantity_in_stock");
    var subunit_quantity_in_stock = $(
        "select[name='product_id'] option:selected"
    ).data("subunit_quantity_in_stock");
    //check if the product is already added
    console.log([category_id, category_name, product_id, product_name]);
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
                .find("input[name='category_id[]']")
                .val(category_id);

            $("tbody tr:last")
                .find("input[name='category_name[]']")
                .val(category_name);

            $("tbody tr:last")
                .find("input[name='product_id[]']")
                .val(product_id);

            $("tbody tr:last")
                .find("input[name='product_name[]']")
                .val(product_name);

            $("tbody tr:last")
                .find("input[name='current_stock[]']")
                .val(current_stock);
        }
    }
});

//addRow function
function addRow() {
    var tr =
        "<tr>" +
        '<td><input type="hidden" name="category_id[]" value=""><input type="text" name="category_name[]" value=""class="form-control" readonly></td>' +
        '<td><input type="hidden" name="product_id[]" value=""><input type="text" name="product_name[]" value="" class="form-control" readonly></td>' +
        '<td><input type="text" name="current_stock[]" value="" class="form-control" readonly></td>' +
        '<td><input type="number" step="any" name="buying_qty[]" value="0" min="0" class="form-control" required></td>' +
        '<td><input type="number" step="any" name="unit_price[]" value="0" min="0" class="form-control" required></td>' +
        '<td><input type="number" step="any" name="buying_price[]" value="0" min="1" class="form-control" readonly></td><td>' +
        '<button type="button" class="btn btn-danger btn-sm removeRow"><i class="bx bx-trash"></i></button></td>' +
        "</tr>";

    $("tbody").append(tr);
}
