/*************************************** sidebar switch button */
function navButtonToggle() {
    var element = document.getElementById("main-first-container");
    element.classList.toggle("sidebar-nav-toggle");
    var elementTwo = document.getElementById("main-snd-container");
    elementTwo.classList.toggle("snd-container-disable-toggle");
}


/************************************** // dashboard side menu */
$('.main-snd-container, .header-div-right-container').click(function () {
    $('.main-first-container').removeClass("sidebar-nav-toggle");
    $('.main-snd-container').removeClass("snd-container-disable-toggle");
});


/*************************************** show first letter in profile pic */
$(document).ready(function(){
    var NameTextDp = $('.header-profile-text').text();
    var intials = NameTextDp.charAt(0);
    var profileImage = $('.header-profile-name').text(intials);
});


//**************************************************** //hide form success message after 5 seconds */
function hideFormMsg() {
    document.getElementById("form-display-message").style.display = "none";
}
setTimeout(hideFormMsg, 5000);


/**************************************************** //push notification */
// Function to close the notification
function closeNotification() {
    var notification = document.getElementById('pushNotification');
    notification.classList.remove('show');
}

var notification = document.getElementById('pushNotification');
notification.classList.add('show');

setTimeout(function() {
    closeNotification();
}, 3000);


/************************ delete a record */
document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {

            var formId = this.getAttribute('data-form-id');
            document.getElementById('delete-form-' + formId).submit();
        });
    });
});
