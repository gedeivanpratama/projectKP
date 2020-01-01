// success message
let flashbox = document.querySelector('.msg-flash');
let flashTitle = flashbox.getAttribute("data-flashTitle");
let flashInfo = flashbox.getAttribute("data-flashInfo");
let status = flashbox.getAttribute('data-status');

if(flashTitle != "" && flashInfo != ""){
    if(status == ""){
        Swal.fire({
            title: flashTitle,
            text: 'Data '+ flashInfo +' Successfully',
            type: 'success'
        });
    }else if(status == "Warning"){
        Swal.fire({
            title: flashTitle,
            text: 'Data '+ flashInfo +' Input',
            type: 'warning'
        });
    }else if(status == "error"){
        Swal.fire({
            title: flashTitle,
            text: 'Data '+ flashInfo +' Invalid or Wrong',
            type: 'error'
        });
    }
    
}




