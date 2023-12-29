$(".status-update").change(function () {
    let id = $(this).data("id");
    let model = $(this).data("model");
    let status = $(this).prop("checked") == true ? 1 : 0;
    let token = "{{ csrf_token() }}";

    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/status-update",
        data: {
            id: id,
            model: model,
            status: status,
        },
        success: function (data) {
            if (data.status == "success") {
                iziToast.success({
                    title: data.message,
                    position: "topRight",
                });
            } else {
                iziToast.error({
                    title: data.message,
                    position: "topRight",
                });
            }
        },
    });
});
