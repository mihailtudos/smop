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

function validateSize(file) {
    var FileSize = file.files[0].size / 1024 / 1024; // in MB
    var ext = $('#image').val().split('.').pop().toLowerCase();

    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
        alert('Invalid extension! The file must be an image.');
        $(file).val(''); //for clearing with Jquery
    } else {
        if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $(file).val(''); //for clearing with Jquery
        }


    }
}

function validateSizeWithFileTitle(file) {
    var FileSize = file.files[0].size / 1024 / 1024; // in MB

    var ext = $('#image').val().split('.').pop().toLowerCase();

    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
        alert('Invalid extension! The file must be an image.');
        $(file).val(''); //for clearing with Jquery
    } else {
        if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $(file).val(''); //for clearing with Jquery
        }
        var fileName = $('#image').val().split('\\').pop().toLowerCase();
        $('#imageCustom').text(fileName);
    }
}

function fillSubjectsField() {
    var fieldIds = $("#fields").val();
    var _token = $('input[name="_token"]').val();
    var dependent = $('#fields').data('dependent');

    alert(fieldIds);
    $.ajax({
        url:"/suggestions/dynamic",
        method:"POST",
        data:{ fieldIds:fieldIds, _token:_token, dependent:dependent },

        success:function(result)
        {
            $('#'+dependent).html(result);
        }

    })
}

function showOptions() {

    var studentsCheck = document.getElementById("studentsCheck");
    var supervisorCheck  = document.getElementById("coordinatorCheck");
    var students = document.getElementById("student");
    var supervisor = document.getElementById("supervisor");


    if (studentsCheck.checked == true && supervisorCheck.checked == false){
        students.style.display = "block";
        supervisor.style.display = "none";
        $("#student").attr("required", true);
        $("#supervisor").val('');
        $("#supervisor").removeAttr("required");
    } else if (studentsCheck.checked == true && supervisorCheck.checked == true){
        $("#student").attr("required", true);
        $("#supervisor").attr("required", true);
        students.style.display = "block";
        supervisor.style.display = "block";
    }   else if (studentsCheck.checked == false && supervisorCheck.checked == true){
        $("#student").val([]);
        $("#student").removeAttr("required");
        students.style.display = "none";
        $("#supervisor").attr("required", true);
        supervisor.style.display = "block";
    } else if (studentsCheck.checked == false && supervisorCheck.checked == false){
        $("#student").removeAttr("required");
        $("#supervisor").removeAttr("required");
        students.style.display = "none";
        supervisor.style.display = "none";
        $("#student").val([]);
        $("#supervisor").val([]);
    }else {

    }


}

