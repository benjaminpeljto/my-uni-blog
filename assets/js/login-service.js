var LoginService = {
	init: function () {
		// This function should check if the user is already logged in
		// If the user is logged in, then redirect to the index.html page
		// This function also initializes the validation of the login form and handles form submission
		// This function should be called from the login.html page
		var token = localStorage.getItem("user_token");
		if (token) {
			window.location.replace("index.html");
		}
		$("#login-form").validate({
			rules: {
				email: {
					required: true,
					email: true,
				},
				password: {
					required: true,
					minlength: 8,
					maxlength: 16,
				},
			},
			messages: {
				email:
					"Enter a valid e-mail address. If you dont have an account, please log in",
			},
			submitHandler: function (form, event) {
				event.preventDefault(); // * used for preventing default behavior,
				// * default: when form is submitted, webpage is reloaded
				var entity = Utils.form2json(form);
				LoginService.login(entity);
			},
		});
	},
	login: function (entity) {
		// This function should send the login ajax request to the server, using the RestClient
		RestClient.post("rest/login", entity, function (result) {
			localStorage.setItem("user_token", result.token);
			window.location.replace("index.html");
		});
	},

	logout: function () {
		// This function should clear the local storage and redirect to the login page (login.html)
		localStorage.clear();
		window.location.replace("login.html");
	},

	checkLoginStatus: function (token) {
		// This function should be called upon opening the application (from the index.html page)
		// This function should check if the user is logged in and redirect to the login page (login.html) if not
		// This function should also check if the user is an admin and display the admin functions if so

		var token = localStorage.getItem("user_token");
		if (token) {
			// if(user.is_admin){
			//     $("#users-link").removeClass("hide");
			// }
		} else {
			window.location.href = "login.html";
		}
	},

	openLoginModal: function () {
		$("#signUpModal").modal("hide");
		$("#loginModal").modal("show");
	},
	closeLoginModal: function () {
		$("#loginModal").modal("hide");
	},
};
