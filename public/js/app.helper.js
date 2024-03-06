let spinner = `<div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>

        <span class="ms-2">Loading...</span>`;

toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: true,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};

function submitForm(formSelector, onSuccess = null) {
    let form = $(formSelector);
    let method = form.attr("method").toLowerCase();
    let btn = $(event.target);

    // if not button or anchor go to parent
    if (btn.prop("tagName").toLowerCase() != "button") {
        btn = btn.parent();
    }

    if (method == "put") {
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Data akan diperbarui!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Perbarui!",
            cancelButtonText: "Batal",
            confirmButtonColor: "#3085d6",
            reverseButtons: true,
        }).then((result) => {
            if (result.value) {
                ajaxSubmitForm(btn, formSelector, onSuccess);
            }
        });
    } else {
        ajaxSubmitForm(btn, formSelector, onSuccess);
    }
}

function ajaxSubmitForm(btn, formSelector, onSuccess = null) {
    let form = $(formSelector);
    let method = form.attr("method").toLowerCase();
    let action = form.attr("action");
    let formData = new FormData(form[0]);

    let innerBtn = btn.html();
    let spinner = `<div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>

        <span class="ms-2">Loading...</span>`;

    if (method == "put") {
        formData.append("_method", "put");
        method = "post";
    }

    $.ajax({
        url: action,
        method: method,
        contentType: false,
        processData: false,
        data: formData,
        beforeSend: function () {
            form.removeClass("was-validated");
            form.find(".invalid-feedback").remove();
            form.find(".is-valid").removeClass("is-valid");
            form.find(".is-invalid").removeClass("is-invalid");
            btn.html(spinner);
            btn.prop("disabled", true);
        },
        success: function (response) {
            if (onSuccess != null) {
                form.find(".invalid-feedback").text("");
                btn.html(innerBtn);
                btn.prop("disabled", false);
                form.trigger("reset");

                if (response.message) {
                    toastr.success(response.message);
                }

                // if onSuccess is function
                if (typeof onSuccess == "function") {
                    onSuccess(response);
                }
            } else {
                location.reload();
            }
        },
        error: function (response) {
            const isJson = isJsonString(response.responseText);
            let errorMessage = "Terjadi kesalahan! Silahkan coba lagi.";

            if (isJson) {
                let datas = response.responseJSON;
                if (response.status == 422) {
                    form.addClass("was-validated");
                    $.each(datas.errors, function (index, value) {
                        let input = form.find('[name="' + index + '"]');
                        if (input.length == 0) {
                            input = form.find('[name="' + index + '[]"]');
                        }

                        input.addClass("is-invalid");
                        input.removeClass("is-valid");

                        // create element .invalid-feedback next to last element parent of input

                        input
                            .parent()
                            .last()
                            .append(
                                '<div class="invalid-feedback">' +
                                    value +
                                    "</div>"
                            );

                        // input.after(
                        //     '<div class="invalid-feedback">' + value + "</div>"
                        // );

                        // let parent = input.parent();
                        // let alert = parent.find('.invalid-feedback');
                        // alert.text(value);
                    });
                }
                errorMessage = datas.message;
            }

            toastr.error(errorMessage);

            btn.html(innerBtn);
            btn.prop("disabled", false);
        },
    });
}

function deleteForm(route, onSuccess = null) {
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
        cancelButtonColor: "#d33",
        confirmButtonColor: "#3085d6",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: route,
                type: "delete",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.message) {
                        toastr.success(response.message);
                    }

                    if (typeof onSuccess == "function" && onSuccess != null) {
                        onSuccess(response);
                    } else {
                        location.reload();
                    }
                },
                error: function (data) {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Data gagal dihapus.",
                        icon: "error",
                    });
                },
            });
        }
    });
}

function setNumberOnlyInput(inputSelector, length = 10) {
    $(inputSelector).on("input", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
        if (this.value.length > length) {
            this.value = this.value.slice(0, length);
        }
    });
}

function setPhoneNumberInput(inputSelector) {
    $(inputSelector).on("input", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
        if (this.value.length > 12) {
            this.value = this.value.slice(0, 12);
        }
        if (this.value.length > 0 && this.value[0] == "0") {
            this.value = this.value.slice(1);
        }
    });
}

function setAlphaSpaceInput(inputSelector, length = 50) {
    $(inputSelector).on("input", function () {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, "");
        if (this.value.length > length) {
            this.value = this.value.slice(0, length);
        }
    });
}

function isJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function showLoader() {
    $(".preloader").show();
}
function hideLoader() {
    $(".preloader").fadeOut();
}

$(document).ready(function () {
    $("input[required], select[required], textarea[required]").each(
        function () {
            let label = $('label[for="' + $(this).attr("id") + '"]');
            let label_text = label.text();
            label.html(label_text + ' <span class="text-danger">*</span>');
        }
    );
});
