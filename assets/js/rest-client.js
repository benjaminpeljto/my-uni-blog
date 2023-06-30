var RestClient = {
    request: function(url, type, body, success, error){
        $.ajax({
            url: url,
            type: type,
            data: JSON.stringify(body),
            contentType: "application/json",
            beforeSend: function(xhr){
                if (localStorage.getItem("token")){ // pass token for authorized requests
                    xhr.setRequestHeader('Authentication', localStorage.getItem("token"));
                }
            },
            success: function(data) {
                success(data);
            },
            error: function(jqXHR, textStatus, errorThrown ){
                if (error){
                    error(jqXHR, textStatus, errorThrown);
                }else{
                    toastr.error(jqXHR.responseJSON.message);
                }
            }
        });
    },

    post: function(url, body, success, error){
        RestClient.request(url, "POST", body, success, error);
    },

    put: function(url, body, success, error){
        RestClient.request(url, "PUT", body, success, error);
    },

    get: function(url, success, error){
        RestClient.request(url, "GET", null, success, error);
    },

    delete: function(url, success, error){
        RestClient.request(url, "DELETE", null, success, error);
    }
}