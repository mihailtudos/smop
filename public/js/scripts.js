function fillDegreeFields() {

    var degreeId = $("#degree").val();
    var _token = $('input[name="_token"]').val();
    var dependent = $('#degree').data('dependent');



    $.ajax({
        url:"/admin/users/dynamic",
        method:"POST",
        data:{degreeId:degreeId, _token:_token, dependent:dependent},

        success:function(result)
        {
            $('#'+dependent).html(result);
        }

    })
}
