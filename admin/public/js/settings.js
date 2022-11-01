const addAnnouncementBtn = document.getElementById('add-announcement-btn');
const clearAnnouncement = document.getElementById('clear-announcement-btn');
const maintenanceModeBtn = document.getElementById('maintenance-mode-btn');
const editContactInfoBtn = document.getElementById('edit-contact-btn');

addAnnouncementBtn.addEventListener('click', () => {
    const ann = document.getElementById('announcement-content').innerHTML
    Swal.fire({
        title: `${ann === 'No announcement' ? 'Add' : 'Update'} Announcement`,  
        html: `
            <div class="form-group">
                <label for="announcement-content">Content</label>
                <textarea class="form-control" id="announcement-content" rows="3">${ann === 'No announcement' ? '' : ann}</textarea>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Add',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
            const content = Swal.getPopup().querySelector('#announcement-content').value

            if (!content) {
                Swal.showValidationMessage(`Content is required`)
            }

            return { content }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const content = result.value.content;
            // Add announcement to database
            const formData = new FormData()
            formData.append('content', content) 

            Swal.fire({
                title: 'Please wait...',
                html: 'We are processing your request',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });

            fetch('/admin/controller/UpdateAnnouncement.php', {
                method: 'POST',
                body: formData
            }).then((response) => {
                return response.json()
            }).then((data) => {
                if (data.status === 'success') {
                    Swal.close();
                    Swal.fire({
                        title: 'Success',
                        text: 'Announcement added',
                        icon: 'success'
                    }).then(() => {
                        loadAnnouncement();
                    })
                } else {
                    Swal.close();
                    Swal.fire({
                        title: 'Error',
                        text: 'Something went wrong',
                        icon: 'error'
                    })
                }
            }).catch((error) => {
                Swal.close();
                Swal.fire({
                    title: 'Error',
                    text: error,
                    icon: 'error'
                })
            })
        }
    })
})

clearAnnouncement.addEventListener('click', () => {
    Swal.fire({
        title: 'Clear Announcement',
        text: 'Are you sure you want to clear the announcement?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Clear',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Clear announcement from database
            Swal.fire({
                title: 'Please wait...',
                html: 'We are processing your request',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            fetch('/admin/controller/DeleteAnnouncement.php', {
                method: 'POST'
            }).then((response) => {
                return response.json()
            }).then((data) => {
                if (data.status === 'success') {
                    Swal.close();
                    Swal.fire({
                        title: 'Success',
                        text: 'Announcement cleared',
                        icon: 'success'
                    }).then(() => {
                        loadAnnouncement();
                    })
                } else {
                    Swal.close();
                    Swal.fire({
                        title: 'Error',
                        text: 'Something went wrong',
                        icon: 'error'
                    })
                }
            }).catch((error) => {
                Swal.close();
                Swal.fire({
                    title: 'Error',
                    text: error,
                    icon: 'error'
                })
            })
        }
    })
})

maintenanceModeBtn.addEventListener('click', () => {
    if(maintenanceModeBtn.innerHTML === 'Enable'){
        Swal.fire({
            title: 'Enable Maintenance Mode',
            text: 'Are you sure you want to enable maintenance mode?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Enable',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enable maintenance mode
                Swal.fire({
                    title: 'Please wait...',
                    html: 'We are processing your request',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                });
                fetch('/admin/controller/UpdateMaintenance.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        mode: 'Enabled'
                    })
                }).then((response) => {
                    return response.json()
                }).then((data) => {
                    if (data.status === 'success') {
                        Swal.close();
                        Swal.fire({
                            title: 'Success',
                            text: 'Maintenance mode enabled',
                            icon: 'success'
                        }).then(() => {
                            maintenanceModeBtn.innerHTML = 'Disable';
                        })
                    } else {
                        Swal.close();
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong',
                            icon: 'error'
                        })
                    }
                }).catch((error) => {
                    Swal.close();
                    Swal.fire({
                        title: 'Error',
                        text: error,
                        icon: 'error'
                    })
                })
            }
        })
    }else{
        Swal.fire({
            title: 'Disable Maintenance Mode',
            text: 'Are you sure you want to disable maintenance mode?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Disable',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Disable maintenance mode
                Swal.fire({
                    title: 'Please wait...',
                    html: 'We are processing your request',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                });
                fetch('/admin/controller/UpdateMaintenance.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        mode: 'Disabled'
                    })
                }).then((response) => {
                    return response.json()
                }).then((data) => {
                    if (data.status === 'success') {
                        Swal.close();
                        Swal.fire({
                            title: 'Success',
                            text: 'Maintenance mode disabled',
                            icon: 'success'
                        }).then(() => {
                            maintenanceModeBtn.innerHTML = 'Enable';
                        })
                    } else {
                        Swal.close();
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong',
                            icon: 'error'
                        })
                    }
                }).catch((error) => {
                    Swal.close();
                    Swal.fire({
                        title: 'Error',
                        text: error,
                        icon: 'error'
                    })
                })
            }
        })
    }
})




const loadAnnouncement = () => {
    fetch('/admin/controller/LoadAnnouncement.php')
        .then((response) => {
            return response.json()
        }).then((data) => {
            if (data.status === 'success') {
                clearAnnouncement.style.display = 'block';  
                addAnnouncementBtn.innerHTML = 'Update Announcement';
                document.getElementById('announcement-content').innerHTML = data.announcement.message;
            }else{
                clearAnnouncement.style.display = 'none';
                addAnnouncementBtn.innerHTML = 'Add Announcement';
                document.getElementById('announcement-content').innerHTML = 'No announcement';
            }
        }).catch((error) => {
            Swal.fire({
                title: 'Error',
                text: error,
                icon: 'error'
            })
        })
}

const fetchMaintenanceMode = () => {
    fetch('/admin/controller/FetchMode.php')
        .then((response) => {
            return response.json()
        }).then((data) => {
            if (data.status === 'success') {
                if(data.mode.mode === "Enabled"){
                    maintenanceModeBtn.innerHTML = 'Disable';
                }else{
                    maintenanceModeBtn.innerHTML = 'Enable';
                }
            }
        }).catch((error) => {
            Swal.fire({
                title: 'Error',
                text: error,
                icon: 'error'
            })
        })
}

const fetchContactInfo = () => {
    fetch('/admin/controller/LoadContactInfo.php')
        .then((response) => {
            return response.json()
        }).then((data) => {
            if (data.status === 'success') {
                const contactInfo = data.contact_details;
                document.getElementById('info-address').innerHTML = contactInfo.address;
                document.getElementById('info-phone-1').innerHTML = `(1) ${contactInfo.phone_number_1}`;
                document.getElementById('info-phone-2').innerHTML = `(2) ${contactInfo.phone_number_2}`;
                document.getElementById('info-email').innerHTML = contactInfo.email;
                document.getElementById('info-facebook').innerHTML = contactInfo.facebook;
                document.getElementById('info-twitter').innerHTML = contactInfo.twitter;
                document.getElementById('info-instagram').innerHTML = contactInfo.instagram;
                document.getElementById('info-gmap').innerHTML = contactInfo.gmap;
                document.getElementById('info-gmap').setAttribute('href', contactInfo.gmap);
                document.getElementById('iframe').src = contactInfo.iframe;
            }
        }).catch((error) => {
            Swal.fire({
                title: 'Error',
                text: error,
                icon: 'error'
            })
        })

}




editContactInfoBtn.addEventListener('click', () => {
    Swal.fire({
        title: 'Please wait...',
        html: 'We are processing your request',
        allowOutsideClick: false,
        showConfirmButton: false
    });
    fetch('/admin/controller/LoadContactInfo.php', {
        method: 'POST'
    }).then((response) => {
        return response.json()
    }).then((data) => {
        if (data.status === 'success') {
            Swal.close();
            Swal.fire({
                title: 'Edit Contact Info',
                html: `
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address-e" value="${data.contact_details.address}">
                </div>
                <div class="form-group">
                    <label for="phone-number-1">Phone Number 1</label>
                    <input type="text" class="form-control" id="phone-number-1-e" value="${data.contact_details.phone_number_1}">
                </div>
                <div class="form-group">
                    <label for="phone-number-2">Phone Number 2</label>
                    <input type="text" class="form-control" id="phone-number-2-e" value="${data.contact_details.phone_number_2}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email-e" value="${data.contact_details.email}">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook-e" value="${data.contact_details.facebook}">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter-e" value="${data.contact_details.twitter}">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram-e" value="${data.contact_details.instagram}">
                </div>
                <div class="form-group">
                    <label for="gmap">Google Map</label>
                    <input type="text" class="form-control" id="gmap-e" value="${data.contact_details.gmap}">
                </div>
                <div class="form-group">
                    <label for="iframe">Iframe</label>
                    <textarea class="form-control" id="iframe-e" rows="3">${data.contact_details.iframe}</textarea>
                </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const address = document.getElementById('address-e').value;
                    const phoneNumber1 = document.getElementById('phone-number-1-e').value;
                    const phoneNumber2 = document.getElementById('phone-number-2-e').value;
                    const email = document.getElementById('email-e').value;
                    const facebook = document.getElementById('facebook-e').value;
                    const twitter = document.getElementById('twitter-e').value;
                    const instagram = document.getElementById('instagram-e').value;
                    const gmap = document.getElementById('gmap-e').value;
                    const iframe = document.getElementById('iframe-e').value;

                    if (!address || !phoneNumber1 || !phoneNumber2 || !email || !facebook || !twitter || !instagram || !gmap || !iframe) {
                        Swal.showValidationMessage(
                            `Please fill out all the fields`
                        )
                    }

                    return {
                        address: address,
                        phoneNumber1: phoneNumber1,
                        phoneNumber2: phoneNumber2,
                        email: email,
                        facebook: facebook,
                        twitter: twitter,
                        instagram: instagram,
                        gmap: gmap,
                        iframe: iframe
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Please wait...',
                        html: 'We are processing your request',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                    fetch('/admin/controller/UpdateContactInfo.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(result.value)
                    }).then((response) => {
                        return response.json()
                    }).then((data) => {
                        if (data.status === 'success') {
                            Swal.close();
                            Swal.fire({
                                title: 'Success',
                                text: data.message,
                                icon: 'success'
                            }).then(() => {
                                fetchContactInfo();
                            })
                        } else {
                            Swal.close();
                            Swal.fire({
                                title: 'Error',
                                text: data.message,
                                icon: 'error'
                            })
                        }
                    }).catch((error) => {
                        Swal.fire({
                            title: 'Error',
                            text: error,
                            icon: 'error'
                        })
                    }
                    )
                }
            })
        } else {
            Swal.close();
            Swal.fire({
                title: 'Edit Contact Info',
                html: `
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address-e" value="">
                </div>
                <div class="form-group">
                    <label for="phone-number-1">Phone Number 1</label>
                    <input type="text" class="form-control" id="phone-number-1-e" value="">
                </div>
                <div class="form-group">
                    <label for="phone-number-2">Phone Number 2</label>
                    <input type="text" class="form-control" id="phone-number-2-e" value="">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email-e" value="">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook-e" value="">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter-e" value="">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram-e" value="">
                </div>
                <div class="form-group">
                    <label for="gmap">Google Map</label>
                    <input type="text" class="form-control" id="gmap-e" value="">
                </div>
                <div class="form-group">
                    <label for="iframe">Iframe</label>
                    <textarea class="form-control" id="iframe-e" rows="3"></textarea>
                </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const address = document.getElementById('address-e').value;
                    const phoneNumber1 = document.getElementById('phone-number-1-e').value;
                    const phoneNumber2 = document.getElementById('phone-number-2-e').value;
                    const email = document.getElementById('email-e').value;
                    const facebook = document.getElementById('facebook-e').value;
                    const twitter = document.getElementById('twitter-e').value;
                    const instagram = document.getElementById('instagram-e').value;
                    const gmap = document.getElementById('gmap-e').value;
                    const iframe = document.getElementById('iframe-e').value;

                    if (!address || !phoneNumber1 || !phoneNumber2 || !email || !facebook || !twitter || !instagram || !gmap || !iframe) {
                        Swal.showValidationMessage(
                            `Please fill out all the fields`
                        )
                    }

                    return {
                        address: address,
                        phoneNumber1: phoneNumber1,
                        phoneNumber2: phoneNumber2,
                        email: email,
                        facebook: facebook,
                        twitter: twitter,
                        instagram: instagram,
                        gmap: gmap,
                        iframe: iframe
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Please wait...',
                        html: 'We are processing your request',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                    fetch('/admin/controller/UpdateContactInfo.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(result.value)
                    }).then((response) => {
                        return response.json()
                    }).then((data) => {
                        if (data.status === 'success') {
                            Swal.close();
                            Swal.fire({
                                title: 'Success',
                                text: data.message,
                                icon: 'success'
                            }).then(() => {
                                fetchContactInfo();
                            })
                        } else {
                            Swal.close();
                            Swal.fire({
                                title: 'Error',
                                text: data.message,
                                icon: 'error'
                            })
                        }
                    }).catch((error) => {
                        Swal.fire({
                            title: 'Error',
                            text: error,
                            icon: 'error'
                        })
                    }
                    )
                }
            })
        }
    }).catch((error) => {
        Swal.fire({
            title: 'Error',
            text: error,
            icon: 'error'
        })
    })
})


loadAnnouncement();
fetchMaintenanceMode();
fetchContactInfo();

