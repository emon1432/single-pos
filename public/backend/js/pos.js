// @ts-nocheck
//cart id array
var cart_id = [];

var order_modal_obj = {};

$(document).ready(function () {
    $(".js-example-basic-single").select2();

    $(".toggle_icon").click(function () {
        $(".product_item_list").toggleClass("d-block");
        $(".product_list").toggleClass("d-none");
    });
    //toggleClass
    $(".product_item_toggle").click(function () {
        $(".product_item").toggleClass("d-block");
        $(".product").toggleClass("d-none");
    });

    setInterval(() => {
        var time = new Date().toLocaleTimeString();
        $("#time").text(time);
    }, 1000);
});

//customer change
$(document).on("change", "#customer_id", function (e) {
    var customer_due = $(this).find(":selected").data("due");
    //2decimal point
    customer_due = parseFloat(customer_due).toFixed(2);
    $("#customer_due").text(customer_due);
    var customer_phone = $(this).find(":selected").data("phone");
    $("#payment_modal").find("input[name=customer_phone]").val(customer_phone);

    //call sub_total function
    total_calculation();
});

//product search on search box
$(document).on("keyup", "#product_search", function (e) {
    var text = $(this).val();

    //trim text
    text = text.replace(/^\s+|\s+$/gm, "");
    if (text.length == 0) {
        text = "";
    }
    //get url
    var url = window.location.href;

    $.ajax({
        url: url + "/product/search",
        type: "GET",
        data: { text: text },
        success: function (data) {
            $("#product_search_result").html(data);
        },
        error: function (data) {
            console.log(data);
        },
    });
});

//product search by select category
$(document).on("change", "#select_category", function (e) {
    var category_id = $(this).val();
    //get url
    var url = window.location.href;

    $.ajax({
        url: url + "/product/search",
        type: "GET",
        data: { category_id: category_id },
        success: function (data) {
            $("#product_search_result").html(data);
        },
        error: function (data) {
            console.log(data);
        },
    });
});

//add product
$(document).on("click", "#product_add_to_cart", function (e) {
    // get from data under a tag id="product_add_to_cart_form"
    var data = this.children.product_add_to_cart_form;
    data = $(data).serializeArray();

    //array to object
    var dataObj = {};
    $(data).each(function (i, field) {
        dataObj[field.name] = field.value;
    });

    if (cart_id.includes(dataObj.product_id)) {
        //increase quantity from cart_list table this product
        var this_product = $("#cart_list")
            .find("tr#cart_items")
            .find("td")
            .find("button")
            .filter(function () {
                return $(this).data("product_id") == dataObj.product_id;
            })
            .closest("tr");
        // unit_quantity
        var unit_quantity = this_product.find("td").eq(2).find("input").val();
        unit_quantity = parseFloat(unit_quantity) + 1;
        this_product.find("td").eq(2).find("input").val(unit_quantity);
        // subunit_quantity
        var subunit_quantity = this_product
            .find("td")
            .eq(4)
            .find("input")
            .val();
        var unit_price = dataObj.product_unit_sale_price;
        var subunit_price = dataObj.product_subunit_sale_price || 0;
        //call quantity_change function
        var total = quantity_change(
            unit_quantity,
            subunit_quantity,
            unit_price,
            subunit_price
        );
        this_product.find("td").eq(5).text(total);

        //order_modal_obj find product_id and increase quantity
        order_modal_obj[dataObj.product_id].unit_quantity =
            unit_quantity;
    } else {
        //cart_id array push
        cart_id.push(dataObj.product_id);
        var html = `<tr id="cart_items">
                    <td colspan="2">${dataObj.product_name}</td>
                    <td>${dataObj.product_unit_sale_price}</td>
                    <td><input class="text-center unit_quantity" type="number" value="1" min="1" required name="unit_quantity[]"></td>
                    <td>${
                        dataObj.product_subunit_sale_price
                            ? dataObj.product_subunit_sale_price
                            : 0
                    }</td>
                    <td><input class="text-center subunit_quantity" type="number" value="0" min="0" required name="subunit_quantity[]"
                    ${
                        dataObj.product_subunit_sale_price ? "" : "disabled"
                    }></td>
                    <td>${parseFloat(dataObj.product_unit_sale_price)}</td>
                    <td><button class="product_item_action text-danger" data-product_id="${
                        dataObj.product_id
                    }">
                    <i class="fas fa-trash-alt"></i>
                </button>
                </td>

                </tr>`;
        //append html to table tbody id="cart_list"
        $("#cart_list").append(html);

        //order_modal_obj create object
        dataObj.product_price = parseFloat(dataObj.product_price);
        order_modal_obj[dataObj.product_id] = {
            product_id: dataObj.product_id,
            product_name: dataObj.product_name,
            product_unit_sale_price: dataObj.product_unit_sale_price,
            product_subunit_sale_price: dataObj.product_subunit_sale_price || 0,
            unit_quantity: 1,
            subunit_quantity: 0,
        };
    }
    //call sub_total function
    total_calculation();
    //total item and product count
    total_item_product();
});

//remove product
$(document).on("click", ".product_item_action", function (e) {
    var product_id = $(this).data("product_id");
    //remove product_id from cart_id array
    cart_id = cart_id.filter(function (value, index, arr) {
        return value != product_id;
    });

    //remove tr
    $(this).closest("tr").remove();

    //remove product_id from order_modal_obj object
    delete order_modal_obj[product_id];

    //call sub_total function
    total_calculation();

    //total item and product count
    total_item_product();
});

//product quantity change
$(document).on("change keyup", "#cart_list input", function (e) {
    var unit_quantity = $(this)
        .closest("tr")
        .find("td")
        .eq(2)
        .find("input")
        .val();
    var subunit_quantity = $(this)
        .closest("tr")
        .find("td")
        .eq(4)
        .find("input")
        .val();
    var unit_price = parseFloat($(this).closest("tr").find("td").eq(1).text());
    var subunit_price = parseFloat(
        $(this).closest("tr").find("td").eq(3).text()
    );

    //call quantity_change function
    var total = quantity_change(
        unit_quantity,
        subunit_quantity,
        unit_price,
        subunit_price
    );
    $(this).closest("tr").find("td").eq(5).text(total);

    //order_modal_obj find product_id and set quantity
    unit_quantity = parseFloat(unit_quantity);
    subunit_quantity = parseFloat(subunit_quantity);
    var product_id = $(this)
        .closest("tr")
        .find("td")
        .find("button")
        .data("product_id");
    order_modal_obj[product_id].unit_quantity = unit_quantity;
    order_modal_obj[product_id].subunit_quantity = subunit_quantity;

    //call sub_total function
    total_calculation();

    //total item and product count
    total_item_product();
});

//form id="others_cost" has many input fields
//find first input fields value and calculate grand total
$(document).on(
    "change keyup",
    "input[name='discount'],input[name='shipping'],input[name='tax'],input[name='other']",
    function (e) {
        //call sub_total function
        total_calculation();
    }
);

//function for quantity change
function quantity_change(
    unit_quantity,
    subunit_quantity = 0,
    unit_price,
    subunit_price = 0
) {
    unit_quantity = parseFloat(unit_quantity);
    subunit_quantity = parseFloat(subunit_quantity);
    unit_price = parseFloat(unit_price);
    subunit_price = parseFloat(subunit_price);
    var total = unit_quantity * unit_price + subunit_quantity * subunit_price;
    total = parseFloat(total);
    total = total.toFixed(2);
    return total;
}

//subtototal calculation
function total_calculation() {
    var sub_total = 0;
    $("#cart_list")
        .find("tr#cart_items")
        .each(function (i, field) {
            var total = $(this).find("td").eq(5).text();
            console.log(total);
            total = parseFloat(total);
            sub_total += total;
        });
    $("#sub_total").text(sub_total);
    var grand_total = 0.0;
    if (sub_total > 0) {
        //get all input fields value from form id="others_cost"
        var others_cost = $("#others_cost").serializeArray();
        //array to object
        var others_costObj = {};
        $(others_cost).each(function (i, field) {
            others_costObj[field.name] = field.value;
        });
        //calculate grand total
        var tax = (parseFloat(others_costObj.tax) * sub_total) / 100;
        var discount = parseFloat(others_costObj.discount);
        var shipping = parseFloat(others_costObj.shipping);
        var other = parseFloat(others_costObj.other);
        grand_total = sub_total + tax + shipping + other - discount;
        //decimal point 2
        grand_total = grand_total.toFixed(2);

        $("#grand_total").text(grand_total);
    } else {
        $("#grand_total").text(0.0);
    }

    //create_order_list
    create_order_list();
}

//total item and total product
function total_item_product() {
    // count of tr in cart_list table
    var count = $("#cart_list").find("tr#cart_items").length;
    $(".total_item").text(count);

    //sum of quantity
    var unit_quantity = 0;
    var subunit_quantity = 0;
    $("#cart_list")
        .find("tr#cart_items")
        .each(function () {
            unit_quantity += parseFloat(
                $(this).find("td").eq(2).find("input").val()
            );
        });
    $("#cart_list")
        .find("tr#cart_items")
        .each(function () {
            subunit_quantity += parseFloat(
                $(this).find("td").eq(4).find("input").val()
            );
        });
    var sum = `${unit_quantity} (Unit) + ${subunit_quantity} (Subunit)`;
    $("#total_product").text(sum);
}

// ===================order modal===================
//payment_modal_btn
$("#payment_modal_btn").on("click", function () {
    //order_modal_obj
    if ($.isEmptyObject(order_modal_obj)) {
        iziToast.warning({
            title: "Please select at least one product",
            position: "topRight",
        });
        return false;
    }
    //get customer name from id="customer_id"
    var customer_name = $("#customer_id").find("option:selected").text();
    $("#payment_modal").find("#customer_name").text(customer_name);
    var customer_id = $("#customer_id").val();
    $("#payment_modal").find("input[name=customer_id]").val(customer_id);
    //show payment_modal
    $("#payment_modal").modal("show");
});

//name=payment_method
$("input[name=payment_method]").on("change", function () {
    let payment_method = $(this).val();
    if (payment_method == "cash") {
        $(".payment_reference").addClass("d-none");
        //remove required attr
        $("#payment_modal")
            .find("input[name=payment_reference]")
            .removeAttr("required");
    } else {
        $(".payment_reference").removeClass("d-none");
        //add required attr
        $("#payment_modal")
            .find("input[name=payment_reference]")
            .attr("required", true);
    }
    var payment_method_id = $(this).data("id");
    $("#payment_modal")
        .find("input[name=payment_method_id]")
        .val(payment_method_id);
});


function create_order_list() {
    // console.log(order_modal_obj);
    //empty order_list
    $("#order_list").empty();
    //order_list html
    var html = "";
    var i = 1;
    for (var key in order_modal_obj) {
        var dataObj = order_modal_obj[key];
        html += `<tr>
                    <td>${i}</td>
                    <td class="w-70">${dataObj.product_name} (x${
            dataObj.unit_quantity
        } Pieces) ${
            dataObj.subunit_quantity
                ? " + (x" + dataObj.subunit_quantity + " Subunit)"
                : ""
        }</td>
        
                    <td class="text-end w-20">${
                        dataObj.product_unit_sale_price *
                            dataObj.unit_quantity +
                        dataObj.product_subunit_sale_price *
                            dataObj.subunit_quantity
                    }</td>
                    <input type="hidden" name="product_id[]" value="${
                        dataObj.product_id
                    }">
                    <input type="hidden" name="unit_quantity[]" value="${
                        dataObj.unit_quantity
                    }">
                    <input type="hidden" name="subunit_quantity[]" value="${
                        dataObj.subunit_quantity
                    }">
                    <input type="hidden" name="unit_sale_price[]" value="${
                        dataObj.product_unit_sale_price
                    }">
                    <input type="hidden" name="subunit_sale_price[]" value="${
                        dataObj.product_subunit_sale_price
                    }">
                </tr>`;
        i++;
    }
    //append html to table tbody id="order_list"
    $("#order_list").append(html);

    //set sub_total
    var sub_total = $("#sub_total").text();
    sub_total = parseFloat(sub_total);
    sub_total = sub_total.toFixed(2);
    $("#payment_modal").find("input[name=sub_total]").val(sub_total);
    $("#payment_modal").find(".sub_total").text(sub_total);

    //set order_tax
    var order_tax = $("input[name=tax]").val();
    order_tax = parseFloat(order_tax);
    order_tax = order_tax.toFixed(2);
    $("#payment_modal").find("input[name=order_tax]").val(order_tax);
    $("#payment_modal")
        .find(".order_tax")
        .text(order_tax + "%");

    //set discount
    var discount = $("input[name=discount]").val();
    discount = parseFloat(discount);
    discount = discount.toFixed(2);
    $("#payment_modal").find("input[name=discount_amount]").val(discount);
    $("#payment_modal")
        .find(".discount_amount")
        .text("- " + discount);

    //set shipping
    var shipping = $("input[name=shipping]").val();
    shipping = parseFloat(shipping);
    shipping = shipping.toFixed(2);
    $("#payment_modal").find("input[name=shipping_charge]").val(shipping);
    $("#payment_modal").find(".shipping_charge").text(shipping);

    //set other
    var other = $("input[name=other]").val();
    other = parseFloat(other);
    other = other.toFixed(2);
    $("#payment_modal").find("input[name=others_charge]").val(other);
    $("#payment_modal").find(".others_charge").text(other);

    //payable_amount
    var payable_amount = $("#grand_total").text();
    payable_amount = parseFloat(payable_amount);
    payable_amount = payable_amount.toFixed(2);
    $("#payment_modal").find("input[name=payable_amount]").val(payable_amount);
    $("#payment_modal").find(".payable_amount").text(payable_amount);

    $("#payment_modal").find("input[name=due_amount]").val(payable_amount);
    $("#payment_modal").find(".due_amount").text(payable_amount);
}

//.full_pay_btn
$(".full_pay_btn").on("click", function () {
    var payable_amount = $("#grand_total").text();
    payable_amount = parseFloat(payable_amount);
    payable_amount = payable_amount.toFixed(2);

    $("#payment_modal").find("input[name=pay_amount]").val(payable_amount);
    $("#payment_modal").find(".due_amount").text(0.0);
    $("#payment_modal").find("input[name=due_amount]").val(0.0);
    $("#payment_modal").find("input[name=paid_amount").val(payable_amount);
    $("#payment_modal").find(".paid_amount").text(payable_amount);
});

//.full_due_btn
$(".full_due_btn").on("click", function () {
    //customer_id
    var customer_id = $("#customer_id").val();
    if (customer_id == 1) {
        //Walking Customer Can't to Create a Due
        iziToast.warning({
            title: "Walking Customer Can't to Create a Due",
            position: "topRight",
        });
        return false;
    }
    var payable_amount = $("#grand_total").text();
    payable_amount = parseFloat(payable_amount);
    payable_amount = payable_amount.toFixed(2);

    $("#payment_modal").find("input[name=pay_amount]").val(0.0);
    $("#payment_modal").find(".due_amount").text(payable_amount);
    $("#payment_modal").find("input[name=due_amount]").val(payable_amount);
    $("#payment_modal").find("input[name=paid_amount").val(0.0);
    $("#payment_modal").find(".paid_amount").text(0.0);
});




//name="pay_amount"
$("input[name=pay_amount]").on("keyup change", function () {
    var pay_amount = $(this).val();
    if (pay_amount == "") {
        pay_amount = 0.0;
    }
    pay_amount = parseFloat(pay_amount);
    pay_amount = pay_amount.toFixed(2);
    var payable_amount = $("#payment_modal")
        .find("input[name=payable_amount]")
        .val();

    var due_amount = payable_amount - pay_amount;
    due_amount = parseFloat(due_amount);
    due_amount = due_amount.toFixed(2);
    var balance = 0.0;
    if (due_amount < 0) {
        balance = Math.abs(due_amount);
        due_amount = 0;
    }

    $("#payment_modal").find(".due_amount").text(due_amount);
    $("#payment_modal").find("input[name=due_amount]").val(due_amount);

    $("#payment_modal").find(".balance").text(balance);
    $("#payment_modal").find("input[name=balance]").val(balance);

    $("#payment_modal").find(".paid_amount").text(pay_amount);
    $("#payment_modal").find("input[name=paid_amount]").val(pay_amount);
});

//id="checkout"
$("#checkout").on("click", function () {
    var customer_id = parseInt($("#customer_id").val());
    var due_amount = parseFloat(
        $("#payment_modal").find("input[name=due_amount]").val()
    );
    var pay_amount = parseFloat(
        $("#payment_modal").find("input[name=pay_amount]").val()
    );
    if (customer_id == 1 && due_amount > 0) {
        iziToast.warning({
            title: "Walking Customer Can't to Create a Due",
            position: "topRight",
        });
        return false;
    }

    //id="payment_form" submit and validate
    var customer_phone = $("input[name=customer_phone]").val();
    if (customer_phone == "") {
        //customer_phone required
        iziToast.warning({
            title: "Customer Phone Number Required",
            position: "topRight",
        });
        //make it focus
        $("input[name=customer_phone]").focus();
        return false;
    }

    $("#payment_form").submit();
});
