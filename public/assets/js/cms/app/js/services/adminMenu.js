angular.module('cms.admin_menu', [])
    .factory('adminMenu', ['$rootScope',
        function($rootScope){
            return function() {
                $rootScope.admin_menu;
                    $rootScope.admin_menu = [
                        {
                            name: "Admin Users",
                            url: "#/admin/users",
                            role: 'admin'
                        },
                        {
                            name: "Your Profile",
                            url: "#/users/profile",
                            role: null
                        },
                        {
                            name: "Pages",
                            url:  "#/admin/pages",
                            role: null
                        },
                        {
                            name: "Logout",
                            url: "/logout",
                            role: null
                        }
                    ];
            }
        }]);