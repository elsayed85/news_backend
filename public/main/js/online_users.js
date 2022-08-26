function setActiveStatus(status, user_id) {
    $.ajax({
        url: site_url + "/setActiveStatus",
        method: "POST",
        data: { _token: auth_token, user_id: user_id, status: status },
        dataType: "JSON",
        success: (data) => {
            // Nothing to do
        },
        error: () => {
            console.error("Server error, check your response");
        },
    });
}

let users = [];
let users_count = 0;
Echo.join('onlineusers').here((users) => {
    users_count = users.length
    console.log(users_count)
})
    .joining((user) => {
        users.push(user);
        users_count = users_count + 1;
        console.log("users count " + users_count + " new user joined")
        console.log(user)
        setActiveStatus(1, user.id);
    })
    .leaving((user) => {
        // users.remove(user);
        console.log(user)
        users_count = users_count - 1;
        console.log("users count " + users_count + " new user leaved")
        setActiveStatus(0, user.id);
    });

Echo.private('App.Models.User.' + user_id)
    .notification((notification) => {
        console.log(notification);
    });
