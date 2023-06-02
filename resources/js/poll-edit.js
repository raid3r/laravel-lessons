
function confirmForm(e) {
    let form = $(e.target).closest('form')
    e.preventDefault()

    Swal.fire({
title: "Confirm",
        text: "Sure ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonTExt: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit()
        }
    })


}

$(document).on('click', 'button[type=submit].need-confirm', confirmForm)
