function loadUser(){
    if($('#datatablesSimple-user').length > 0) {
        $.ajax({
            url: `${$url}user/get/list`,
            method: "GET",
            dataType: "json",
            beforeSend: function() {
                showLoading();
            },
            success: function(data) {
                if (!data || !data.length) {
                    hideLoading();
                    return;
                }

                if (window.datatable) {
                    window.datatable.destroy();
                }

                window.datatable = new window.simpleDatatables.DataTable("#datatablesSimple-user", {
                    data: {
                        headings: Object.keys(data[0]),
                        data: data.map(function(item) {
                            return Object.values(item);
                        })
                    }
                });
                hideLoading();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Failed to fetch data:", textStatus, errorThrown);
            }
        });
    }
}

function loadDoctor(){
    if($('#datatablesSimple-doctor').length > 0) {
        $.ajax({
            url: `${$url}doctor/get/list`,
            method: "GET",
            dataType: "json",
            beforeSend: function() {
                showLoading();
            },
            success: function(data) {
                if (!data || !data.length) {
                    hideLoading();
                    return;
                }

                if (window.datatable) {
                    window.datatable.destroy();
                }

                window.datatable = new window.simpleDatatables.DataTable("#datatablesSimple-doctor", {
                    data: {
                        headings: Object.keys(data[0]),
                        data: data.map(function(item) {
                            return Object.values(item);
                        })
                    }
                });
                hideLoading();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Failed to fetch data:", textStatus, errorThrown);
            }
        });
    }
}

function toast( tType, message ){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr[tType](message);
}

function showLoading() {
    $('#loading').show();
}

function hideLoading() {
    $('#loading').hide();
}

function clearFields(form){
    return $(form)[0].reset();
}

 function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

async function doLogin(){
    let formData = document.getElementById('form-login');
    let buttons = $('#btn-login');
    let btnText = '';

    await $.ajax({
        url: `${$url}login`,
        type: 'POST',
        data: new FormData(formData),
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend : function(){
            btnText = buttons.text();
            buttons.html(
                `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> 
                ${ buttons.attr("button-message") }`
                ).addClass('disabled');
        },
        success: function(data){
            let json = $.parseJSON(data);
            if(json.status == 200){
                window.location = $url + json.redirect
            }else{
                toast(json.response, json.response_message);
                clearFields(formData);
                buttons.removeClass('disabled').html(btnText);
            }
           
        },
        error : function(xhr, status, errorThrown){
            toast('error', `Error: ${xhr.status} - ${xhr.statusText}`);
            clearFields(formData);
            buttons.removeClass("disabled").html(btnText);
        }
    });
}

async function doAddUser() {
    let formData = document.getElementById('form-add-user');
    let buttons = $('#btn-form-add-user');
    
    await $.ajax({
        url: `${$url}user/details/store`,
        type: 'POST',
        data: new FormData(formData),
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            btnText = buttons.text();
            buttons.html(
                `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> 
                ${buttons.attr("button-message")}`
                ).addClass('disabled');
        },
        success: function(data) {
            let json = $.parseJSON(data);
            if (json.status == 200) {
                toast(json.response, json.response_message);
                clearFields(formData);
            } else {
                toast(json.response, json.response_message);
            }
            buttons.removeClass('disabled').html(btnText);
        },
        error: function(xhr, status, errorThrown) {
            toast('error', `Error: ${xhr.status} - ${xhr.statusText}`);
            clearFields(formData);
            buttons.removeClass("disabled").html(btnText);
        }
    });
}

async function doUpdateUser(){
    let formData = document.getElementById('form-add-user');
    let buttons = $('#btn-form-add-user');
    
    await $.ajax({
        url: `${$url}user/details/put`,
        type: 'POST',
        data: new FormData(formData),
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            btnText = buttons.text();
            buttons.html(
                `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> 
                ${buttons.attr("button-message")}`
                ).addClass('disabled');
        },
        success: function(data) {
            let json = $.parseJSON(data);
            if (json.status == 200) {
                toast(json.response, json.response_message);
                clearFields(formData);
            } else {
                toast(json.response, json.response_message);
            }
            buttons.removeClass('disabled').html(btnText);
        },
        error: function(xhr, status, errorThrown) {
            toast('error', `Error: ${xhr.status} - ${xhr.statusText}`);
            clearFields(formData);
            buttons.removeClass("disabled").html(btnText);
        }
    });
}

function deleteUser(userId) {
    Swal.fire({
        title:"Warning",
        html: 'Are you sure you want to delete this user?',
        icon: 'warning',
        showCancelButton:!0,
        confirmButtonColor:"#3085d6",
        cancelButtonColor:"#d33",
        confirmButtonText:"Yes",
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading()
    }).then(function(result){
        if (result.isConfirmed) {
            $.post($url + 'user/details/delete',{"id":userId },function(data){
                if( isJson(data) ){
                    var json = $.parseJSON(data);
                    switch (json.status) {
                        case 401:
                            tType = json.response;
                            message = json.response_message;
                            break;
                        case 200:
                            tType = json.response;
                            message = json.response_message;
                        default:
                            break;
                    }
                    toast(tType, message);
                    loadUser();
                } else {
                    console.log(data);
                }
            })
            .fail(function() {
                toast('error', 'Something went wrong!');
            });
        }        
    });
}

function resetUserPass(userId){
    Swal.fire({
        title:"Warning",
        html: 'Are you sure you want to reset the password of this user?',
        icon: 'warning',
        showCancelButton:!0,
        confirmButtonColor:"#3085d6",
        cancelButtonColor:"#d33",
        confirmButtonText:"Yes",
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading()
    }).then(function(result){
        if (result.isConfirmed) {
            $.post($url + 'user/details/reset',{"id":userId },function(data){
                if( isJson(data) ){
                    var json = $.parseJSON(data);
                    switch (json.status) {
                        case 401:
                            tType = json.response;
                            message = json.response_message;
                            break;
                        case 200:
                            tType = json.response;
                            message = json.response_message;
                        default:
                            break;
                    }
                    toast(tType, message);
                    loadUser();
                } else {
                    console.log(data);
                }
            })
            .fail(function() {
                toast('error', 'Something went wrong!');
            });
        }        
    });
}

async function doAddDoctor() {
    let formD = document.getElementById('form-add-doctor');
    let formData = new FormData(formD);
    let buttons = $('#btn-form-add-doctor');

    $('.additional-contact-no').each(function() {
        let contactNumber = $(this).val();
        formData.append('contact_no[]', contactNumber);
    });
    
    await $.ajax({
        url: `${$url}doctor/details/store`,
        type: 'POST',
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            btnText = buttons.text();
            buttons.html(
                `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> 
                ${buttons.attr("button-message")}`
                ).addClass('disabled');
        },
        success: function(data) {
            let json = $.parseJSON(data);
            if (json.status == 200) {
                toast(json.response, json.response_message);
                $('#doctor-photo').attr('src',`${$url}assets/images/user-placeholder.svg`);
                clearFields(formD);
                $('#additional-contact').empty();
            } else {
                toast(json.response, json.response_message);
            }
            buttons.removeClass('disabled').html(btnText);
        },
        error: function(xhr, status, errorThrown) {
            toast('error', `Error: ${xhr.status} - ${xhr.statusText}`);
            clearFields(formD);
            $('#additional-contact').empty();
            buttons.removeClass("disabled").html(btnText);
        }
    });
}

async function doUpdateDoctor(){
    let formD = document.getElementById('form-add-doctor');
    let formData = new FormData(formD);
    let buttons = $('#btn-form-add-doctor');

    $('.additional-contact-no').each(function() {
        let contactNumber = $(this).val();
        formData.append('contact_no[]', contactNumber);
    });
    
    await $.ajax({
        url: `${$url}doctor/details/put`,
        type: 'POST',
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            btnText = buttons.text();
            buttons.html(
                `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> 
                ${buttons.attr("button-message")}`
                ).addClass('disabled');
        },
        success: function(data) {
            let json = $.parseJSON(data);
            if (json.status == 200) {
                toast(json.response, json.response_message);
            } else {
                toast(json.response, json.response_message);
            }
            buttons.removeClass('disabled').html(btnText);
        },
        error: function(xhr, status, errorThrown) {
            toast('error', `Error: ${xhr.status} - ${xhr.statusText}`);
            buttons.removeClass("disabled").html(btnText);
        }
    });
}

function deleteDoctor(doctorId){
    Swal.fire({
        title:"Warning",
        html: 'Are you sure you want to delete this doctor?',
        icon: 'warning',
        showCancelButton:!0,
        confirmButtonColor:"#3085d6",
        cancelButtonColor:"#d33",
        confirmButtonText:"Yes",
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading()
    }).then(function(result){
        if (result.isConfirmed) {
            $.post($url + 'doctor/details/delete',{"id":doctorId },function(data){
                if( isJson(data) ){
                    var json = $.parseJSON(data);
                    switch (json.status) {
                        case 401:
                            tType = json.response;
                            message = json.response_message;
                            break;
                        case 200:
                            tType = json.response;
                            message = json.response_message;
                        default:
                            break;
                    }
                    toast(tType, message);
                    loadDoctor();
                } else {
                    console.log(data);
                }
            })
            .fail(function() {
                toast('error', 'Something went wrong!');
            });
        }        
    });
}

$(function(){
    loadUser();
    loadDoctor();

    $('#upload-button').on('click', function() {
        $('#photo-input').click();
    });

    $('#photo-input').on('change', function(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#doctor-photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    let contactIndex = 1;

    $('#btn-add-contact').on('click', function(){
        contactIndex++;
        $('#additional-contact').append(`
            <div class="row gx-3 mb-3" id="contact-${contactIndex}">
                <div class="col-md-6">
                    <label class="small mb-1" for="inputFirstName">Another Contact No</label>
                    <div class="input-group">
                        <input
                            class="form-control additional-contact-no"
                            id="inputContactNo-${contactIndex}"
                            type="number"
                            name="contactno[]"
                            placeholder="Enter Contact Number"
                            autocomplete="off"
                            required />
                            <button class="btn btn-outline-danger btn-remove-contact" type="button" data-contact-id="contact-${contactIndex}">-</button>
                    </div>
                </div>
            </div>
        `);
    });

    $('#additional-contact').on('click', '.btn-remove-contact', function(){
        const contactId = $(this).data('contact-id');
        $('#' + contactId).remove();
    });
});