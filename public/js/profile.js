function enableEdit() {
    document.getElementById('fullname').readOnly = false;
    document.getElementById('email').readOnly = false;
    document.getElementById('phone').readOnly = false;
    document.getElementById('date').readOnly = false;
    document.getElementById('edit_image').disabled = false;
    document.getElementById('nam').disabled = false;
    document.getElementById('nu').disabled = false;
    // Enable other fields if needed

    document.getElementById('editButton').style.display = 'none';
    document.getElementById('saveButton').style.display = 'block';
} 