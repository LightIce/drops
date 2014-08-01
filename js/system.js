// submit the form and md5 the password and confirm password
function SubmitForm() {
	document.getElementById("password").value = hex_md5(document.getElementById("password").value);
	document.getElementById("ConfirmPassword").value = hex_md5(document.getElementById("ConfirmPassword").value);
	this.signup.submit();
}

function SubmitLoginForm() {
	document.getElementById("password").value = hex_md5(document.getElementById("password").value);
	this.login.submit();
}

function DelayURL(url, time) {
	setTimeout("top.location.href='" + url + "'", time);
}