var NavigationBarService = {
    init: function (){
        $('.nav-link').on('click', function () {
            $('.navbar-collapse').collapse('hide');
        });
        if(Utils.isAdmin()){
            NavigationBarService.assignAdminNavBar();
        }
        else{
            NavigationBarService.assignUserNavBar();
        }
    },

    assignAdminNavBar: function (){
        if($("#toastr_admin").val() === "false"){
            toastr.warning("WELCOME ADMIN!", "", { positionClass: "toast-top-center" });
            $("#toastr_admin").val("true");
        }
        const nav_admin = "" +
            "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#home\">Home</a></li>\n" +
            "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#statistics\">Statistics</a></li>\n" +
            "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" onclick=\"ProfileService.init()\" href=\"#profile\">Profile</a></li>\n" +
            "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" onclick=\"LoginService.logout()\">Log Out</a></li>";


        $("#tabs").html(nav_admin);
    },

    assignUserNavBar: function (){
        const nav_regular = "<li class=\"nav-item\"><a class=\"createbuttonnavlink nav-link px-lg-3 py-3 py-lg-4\" onclick=\"BlogsService.openCreateModal()\">Create</a></li>\n" +
            "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" onclick=\"Favorite_blogsService.init()\" href=\"#favorites\">Favorites</a></li>\n" +
            "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#home\">Home</a></li>\n" +
            "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" onclick=\"ProfileService.init()\" href=\"#profile\">Profile</a></li>\n" +
            "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" onclick=\"LoginService.logout()\">Log Out</a></li>";

        $("#tabs").html(nav_regular);
    }
}