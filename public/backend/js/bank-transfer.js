// @ts-nocheck
$(document).ready(function () {
    // From Account Balance
    $('select[name="from_account"]').on("change", function () {
        var from_account = $(this).val();
        var from_account_deposit = $(
            'select[name="from_account"] option:selected'
        ).data("deposit");
        var from_account_withdraw = $(
            'select[name="from_account"] option:selected'
        ).data("withdraw");
        var from_account_transfer_to_other = $(
            'select[name="from_account"] option:selected'
        ).data("transfer_to_other");
        var from_account_transfer_from_other = $(
            'select[name="from_account"] option:selected'
        ).data("transfer_from_other");
        var from_account_balance =
            from_account_deposit +
            from_account_transfer_from_other -
            (from_account_withdraw + from_account_transfer_to_other);
        $('input[name="from_account_balance"]').val(from_account_balance);
    });
    // To Account Balance
    $('select[name="to_account"]').on("change", function () {
        var to_account = $(this).val();
        var to_account_deposit = $(
            'select[name="to_account"] option:selected'
        ).data("deposit");
        var to_account_withdraw = $(
            'select[name="to_account"] option:selected'
        ).data("withdraw");
        var to_account_transfer_to_other = $(
            'select[name="to_account"] option:selected'
        ).data("transfer_to_other");
        var to_account_transfer_from_other = $(
            'select[name="to_account"] option:selected'
        ).data("transfer_from_other");
        var to_account_balance =
            to_account_deposit +
            to_account_transfer_from_other -
            (to_account_withdraw + to_account_transfer_to_other);
        $('input[name="to_account_balance"]').val(to_account_balance);
    });

    // Check Same Account after Submit
    $("form").on("submit", function () {
        var from_account = $('select[name="from_account"]').val();
        var to_account = $('select[name="to_account"]').val();
        if (from_account == to_account) {
            iziToast.warning({
                title: "You Can Not Transfer To Same Account",
                position: "topRight",
            });
            return false;
        }
        // Check Transfer Amount
        var from_account_balance = parseFloat(
            $('input[name="from_account_balance"]').val()
        );
        var transfer_amount = parseFloat(
            $('input[name="transfer_amount"]').val()
        );
        if (transfer_amount > from_account_balance) {
            iziToast.warning({
                title: "Insufficient Balance",
                position: "topRight",
            });
            return false;
        }
    });
});
