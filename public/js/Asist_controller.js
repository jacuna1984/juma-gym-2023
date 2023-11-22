// document.addEventListener(MessageEvent,function(){
//     alert(message);
// });

// document.addEventListener("DOMContentLoaded", function(event) {
// })
// ;

    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('message');


    if (successMessage) {
        alert(successMessage);
        window.location.href = 'index.php';
    }