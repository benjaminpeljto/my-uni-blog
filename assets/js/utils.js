var Utils = {

    form2json: function(form){
        var array = $(form).serializeArray();
        var json = {};
        $.each(array, function() {
            json[this.name] = this.value || '';
        });
        return json;
    },

    parseJwt: function(token){
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

    getCurrentUserId: function(){
        var token = localStorage.getItem("user_token");
        var user = Utils.parseJwt(token);
        return parseInt(user.id);
    },

    isAdmin: function (){
        var token = localStorage.getItem("user_token");
        var user = Utils.parseJwt(token);
        return user.admin;
    }

}