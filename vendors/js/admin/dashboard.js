const alert = (type,msg) =>{
    const bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    const element = document.createElement('div');
    element.innerHTML = `
    <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
        <strong>${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;
    document.body.append(element);
}