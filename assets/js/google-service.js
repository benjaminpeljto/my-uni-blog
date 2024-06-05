$(document).ready(function () {
	LoginService.init();
	SignupService.init();
	handleTokenRedirect();
});

var GoogleService = GoogleService || {};
GoogleService.googleLogin = function () {
	$.get("rest/google-login", function (response) {
		if (response.authUrl) {
			window.location.href = response.authUrl;
		} else {
			toastr.error("Failed to initiate Google login.");
		}
	}).fail(function () {
		toastr.error("Error connecting to server for Google login.");
	});
};

function handleTokenRedirect() {
	const token = new URLSearchParams(window.location.search).get("token");
	if (token) {
		localStorage.setItem("user_token", token);
		var newUrl =
			window.location.protocol +
			"//" +
			window.location.host +
			window.location.pathname;
		window.history.replaceState({ path: newUrl }, "", newUrl);
		window.location.href = "index.html";
	}
}

if (window.location.search.includes("token")) {
	handleTokenRedirect();
}
