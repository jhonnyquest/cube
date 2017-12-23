

function setTestCases(){
    $.post(
        "/cube/test_cases",
        {
            "_token": "{{ csrf_token() }}",
            "test_cases": $('#test_cases').val()
        }
    ).done(function (response) {
        if(response.success){
            $('#test_cases').val('');
            $('#test_cases_modal').modal('toggle');
            $('#settings_modal').modal('show');
        }else{
            alert(response.error);
        }
    }).fail(function (data) {
        alert(data.responseJSON.error);
    });
}

function createCube(){
    $.post(
        "/cube",
        {
            "_token": "{{ csrf_token() }}",
            "matrix_dimension": $('#matrix_dimension').val(),
            "quantity_commands": $('#quantity_commands').val()
        }
    ).done(function (response) {
        if(response.success){
            $('#quantity_commands').val('')
            $('#matrix_dimension').val('');
            $('#settings_modal').modal('toggle');
            $('#calc_modal').modal('show');
        }else{
            alert(response.error);
        }
    }).fail(function (data) {
        alert(data.responseJSON.error);
    });
}

function updateCube(){
    if($('#update').val() === '') {
        alert('Field "Update comand" cannot be empty');
        return;
    }

    var request = $('#update').val().split(" ");
    if(request.length < 4) {
        alert('data missing');
        return;
    }

    $.post(
        "/cube/update",
        {
            "_token": "{{ csrf_token() }}",
            "x": request[0],
            "y": request[1],
            "z": request[2],
            "value": request[3]
        }
    ).done(function (response) {
        if(response.success){
            alert('Cube successfully updated');
        }else{
            alert(response.error);
            $('#update').val('');
            $('#query').val('');
            if(response.error === 'actions restored'){
                alert('Next test case')
                $('#calc_modal').modal('toggle');
                $('#settings_modal').modal('show');
            }else if(response.error === 'No more test cases'){
                $('#calc_modal').modal('toggle');
                deleteCube();
            }
        }
    }).fail(function (data) {
        alert(data.responseJSON.error);
    });
}

function queryCube(){
    if($('#query').val() === '') {
        alert('Field "Update comand" cannot be empty');
        return;
    }

    var request = $('#query').val().split(" ");
    if(request.length < 5) {
        alert('data missing');
        return;
    }

    $.post(
        "/cube/query",
        {
            "_token": "{{ csrf_token() }}",
            "x1": request[0],
            "y1": request[1],
            "z1": request[2],
            "x2": request[3],
            "y2": request[4],
            "z2": request[5]
        }
    ).done(function (response) {
        if(response.success){
            $('#result').val(response.result)
        }else{
            alert(response.error);
            $('#update').val('');
            $('#query').val('');
            if(response.error === 'actions restored'){
                alert('Next test case')
                $('#calc_modal').modal('toggle');
                $('#settings_modal').modal('show');
            }else if(response.error === 'No more test cases'){
                $('#calc_modal').modal('toggle');
                deleteCube();
            }
        }
    }).fail(function (data) {
        alert(data.responseJSON.error);
    });
}

function deleteCube(){
    $('#update').val('');
    $('#query').val('');
    $('#quantity_commands').val('');
    $('#matrix_dimension').val('');
    $('#test_cases').val('');
    $.ajax({
        url: '/cube',
        type: 'DELETE',
        success: function(result) {
        }
    });
}