//
// Single delete data from table
//
$('.delete-btn').click(function () {
    var deleteFormId = $(this).data("id");

    commonSwalAlert(deleteFormId); // Calling Custom created Function
});

//
//  it is used to open multiple delete button
//
$(".checkitem").change(function () {
    if (this.checked) {
        $('#multiple_delete_btn').removeClass('d-none');
    }
    else if ($(".table input[name='id']:checked").length < 1) {
        $('#multiple_delete_btn').addClass('d-none');
        $('#check_all_box').prop('checked', false);
    }
});

// Check all boxes
$(document).ready(function () {

    $('#check_all_box').click(function (event) {
        if (this.checked) {
            $('.checkitem').each(function () {
                this.checked = true;
                $('#multiple_delete_btn').removeClass('d-none');
            });
        } else {
            $('.checkitem').each(function () {
                this.checked = false;
                $('#multiple_delete_btn').addClass('d-none');
            });
        }
    });

});


//
// using selected delete multiple rows data from table
//
$('#multiple_delete_btn').on('click', function (e) {
    let selctedIds = [];
    $("input:checkbox[name=id]:checked").each(function () {
        selctedIds.push($(this).val());
    });

    commonSwalAlert(selctedIds); // Calling Custom created Function
});

//
//Common function for delete and swal fite alert
//
function commonSwalAlert(selctedIds) {
    //
    // defining values for swal fire
    //
    var swalWidth = 600;
    var swalTextColor = "#fff";
    var swalPadding = "3em";
    var swalBackground = `rgba(0, 0, 0, 0.5)`;
    var swalBackdrop = `rgba(0,0,123,0.1) left top no-repeat`;

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",

        padding: swalPadding,
        color: swalTextColor,
        width: swalWidth,
        background: swalBackground,
        backdrop: swalBackdrop
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success",
                confirmButtonColor: "red",

                padding: swalPadding,
                color: swalTextColor,
                width: swalWidth,
                background: swalBackground,
                backdrop: swalBackdrop
            });

            setTimeout(function () {
                $('#delete_form').append(`<input name="ids" value="` +
                    selctedIds + `">`).submit();
            }, 600);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swal.fire({
                title: "Cancelled",
                text: " ",
                icon: "error",
                confirmButtonColor: "red",

                padding: swalPadding,
                color: swalTextColor,
                width: swalWidth,
                background: swalBackground,
                backdrop: swalBackdrop
            });
        }
    });
}

// Fadeout Messages
setTimeout(function () {
    $('.feedback-fadeout').fadeOut('fast');
}, 3000);
