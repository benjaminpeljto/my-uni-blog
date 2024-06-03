var StatsService = {
    init: function (){
        StatsService.getNumberOfBlogs();
        StatsService.getNumberOfUsers();
        StatsService.getAllUsers();
    },

    getNumberOfBlogs: function (){
        RestClient.get(
            "rest/numberofblogs",
            function (data){
                $("#totalBlogs").html(data);
            }
        )
    },

    getNumberOfUsers: function (){
        RestClient.get(
            "rest/numberofusers",
            function (data){
                $("#totalUsers").html(data);
            }
        )
    },

    getAllUsers: function() {
        RestClient.get("rest/admin/all-users", function(users) {
            const userList = $("#userList");
            userList.empty(); // Clear any existing content

            users.forEach(user => {
                const banButton = user.banned
                    ? `<button class="btn btn-success mt-3" style="font-size: 0.875rem; padding: 0.5rem 1rem;" onclick="StatsService.unbanUser(${user.id})">Unban User</button>`
                    : `<button class="btn btn-danger mt-3" style="font-size: 0.875rem; padding: 0.5rem 1rem;" onclick="StatsService.banUser(${user.id})">Ban User</button>`;

                const userCard = $(`
                <div class="card mb-4" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); border: none; transition: transform 0.2s;">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <h5 class="card-title" style="font-size: 1.25rem; color: #007bff; font-weight: bold;">${user.user}</h5>
                            <p class="card-text" style="font-size: 1rem; color: #333;"><strong>Total blogs:</strong> ${user.total_blogs}</p>
                            <p class="card-text" style="font-size: 1rem; color: #333;"><strong>Total likes:</strong> ${user.total_likes}</p>
                        </div>
                        ${banButton}
                    </div>
                </div>
            `);

                // Add hover effect using jQuery
                userCard.hover(
                    function() {
                        $(this).css('transform', 'translateY(-10px)');
                    }, function() {
                        $(this).css('transform', 'translateY(0)');
                    }
                );

                userList.append(userCard);
            });
        });
    },

    banUser: function(user_id) {
        RestClient.put("rest/admin/ban-user/" + user_id, null, function(response) {
            if(response.success) {
                toastr.success(response.message);
                StatsService.getAllUsers();
            } else {
                toastr.error(response.message);
            }
        });
    },

    unbanUser: function(user_id) {
        RestClient.put("rest/admin/unban-user/" + user_id, null, function(response) {
            if(response.success) {
                toastr.success(response.message);
                StatsService.getAllUsers();
            } else {
                toastr.error(response.message);
            }
        });
    }

}