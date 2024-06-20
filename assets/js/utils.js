var Utils = {
	form2json: function (form) {
		var array = $(form).serializeArray();
		var json = {};
		$.each(array, function () {
			json[this.name] = this.value || "";
		});
		return json;
	},

	parseJwt: function (token) {
		if (token) {
			var base64Url = token.split(".")[1];
			var base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
			var jsonPayload = decodeURIComponent(
				atob(base64)
					.split("")
					.map(function (c) {
						return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
					})
					.join("")
			);
			return JSON.parse(jsonPayload);
		} else {
			return null;
		}
	},

	getCurrentUserId: function () {
		var token = localStorage.getItem("user_token");
		var user = Utils.parseJwt(token);
		return parseInt(user.id);
	},

	isAdmin: function () {
		var token = localStorage.getItem("user_token");
		var user = Utils.parseJwt(token);
		return user.admin;
	},

	getProfilePicture: function () {
		var token = localStorage.getItem("user_token");
		var user = Utils.parseJwt(token);
		return user.profile_picture;
	},
};

function getURLParameter(name) {
	return (
		decodeURIComponent(
			(new RegExp("[?|&]" + name + "=" + "([^&;]+?)(&|#|;|$)").exec(
				location.search
			) || [null, ""])[1].replace(/\+/g, "%20")
		) || null
	);
}

$(document).ready(function () {
	var token = getURLParameter("token");
	if (token) {
		localStorage.setItem("user_token", token);
		console.log("JWT Token saved from URL: " + token);

		var newUrl =
			window.location.protocol +
			"//" +
			window.location.host +
			window.location.pathname;
		window.history.replaceState({ path: newUrl }, "", newUrl);
		window.location.replace("index.html");
	} else {
		console.log("No JWT Token found in URL.");

		console.log("Checking for login status...");
		var storedToken = localStorage.getItem("user_token");
		if (!storedToken && window.location.pathname.endsWith("/login.html")) {
			console.log("On login page but no token found, staying on login page...");
		} else if (!storedToken) {
			console.log("No token found in local storage, redirecting to login...");
			window.location.href = "login.html";
		} else {
			console.log("Token found in local storage: " + storedToken);
			NavigationBarService.init();
		}
	}
});
