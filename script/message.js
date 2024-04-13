function displayMessage(message, type) {
    var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    var alertMessage = '<div class="alert ' + alertClass + '" role="alert">' + message + '</div>';
    document.getElementById('messageContainer').innerHTML = alertMessage;
}