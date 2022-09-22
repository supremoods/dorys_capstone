let general_data, contacts_data;

let general_settings_form = document.getElementById('general-settings-form');
let web_title_f = document.getElementById('web_title_f');
let web_about_f = document.getElementById('web_about_f');

let contacts_s_form = document.getElementById('contacts_s_form');

function get_general() {

    let web_title = document.getElementById('web_title');
    let web_about = document.getElementById('web_about');


    let shutdown_toggle = document.getElementById('shutdown-toggle');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        general_data = JSON.parse(this.responseText);

        web_title.innerText = general_data.web_title;
        web_about.innerText = general_data.web_about;


        web_title_f.value = general_data.web_title;
        web_about_f.value = general_data.web_about;

        if (general_data.shutdown == 0) {
            shutdown_toggle.checked = false;
            shutdown_toggle.value = 0;
        } else {
            shutdown_toggle.checked = true;
            shutdown_toggle.value = 1;

        }
    }

    xhr.send('get_general');
}

general_settings_form.addEventListener('submit', function(e) {
    e.preventDefault();
    upd_general(web_title_f.value, web_about_f.value);
})

function upd_general(web_title_val, web_about_val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        var myModalEl = document.getElementById('general-settings')
        var modal = bootstrap.Modal.getInstance(myModalEl)
        modal.hide()

        if (this.responseText == 1) {
            alert('success', 'Changes saved!');
            get_general();
        } else {
            alert('error', 'No Changes!');
        }
    }
    xhr.send('web_title=' + web_title_val + '&web_about=' + web_about_val + '&upd_general');
}

function upd_shutdown(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.responseText == 1 && general_data.shutdown == 0) {
            alert('success', 'Site has been shutdown!');
        } else {
            alert('success', 'Shutdown mode off!');
        }
        get_general();
    }
    xhr.send('upd_shutdown=' + val);
}

function get_contacts() {
    let contacts_p_id = ['address', 'gmap', 'mn1', 'mn2', 'mail', 'tw', 'fb'];
    let iframe = document.getElementById('iframe');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        contacts_data = JSON.parse(this.responseText);
        contacts_data = Object.values(contacts_data);

        for (i = 0; i < contacts_p_id.length; i++) {
            document.getElementById(contacts_p_id[i]).innerText = contacts_data[i + 1];
        }
        iframe.src = contacts_data[8];
        contacts_f(contacts_data);
    }

    xhr.send('get_contacts');
}

function contacts_f(data) {
    let contacts_f_id = ['address_f', 'gmap_f', 'mn1_f', 'mn2_f', 'mail_f', 'tw_f', 'fb_f', 'iframe_f'];
    for (i = 0; i < contacts_f_id.length; i++) {
        document.getElementById(contacts_f_id[i]).value = data[i + 1];
    }
}

contacts_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    upd_contacts();
})

function upd_contacts() {
    let index = ['address', 'gmap', 'mn1', 'mn2', 'mail', 'tw', 'fb', 'iframe'];
    let contacts_f_id = ['address_f', 'gmap_f', 'mn1_f', 'mn2_f', 'mail_f', 'tw_f', 'fb_f', 'iframe_f'];

    let data_str = "";

    for (i = 0; index.length; i++) {
        data_str += index[i] + "=" + document.getElementById(contacts_f_id[i]).value + '&';
    }

    data_str += "upd_contacts";

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        var myModalEl = document.getElementById('contact-settings')
        var modal = bootstrap.Modal.getInstance(myModalEl)
        modal.hide()

        if (this.responseText == 1 && general_data.shutdown == 0) {
            alert('success', 'Changes Saved!');
            get_contacts();
        } else {
            alert('error', 'No Changes!');
        }
    }
    xhr.send(data_str);
}

window.onload = function() {
    get_general();
    get_contacts();
}