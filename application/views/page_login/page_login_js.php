<script>
    $(document).ready(function() {
        $("#btn-login").on("click", function() {
            event.preventDefault();

            var username = $("#username").val()
            var password = $("#password").val()

            if (username === "" || password === "") {
                showAlert('error', 'Username or Password Empty')
                return;
            }

            $.ajax({
                url: baseURL + "/auth/signIn",
                type: "POST",
                data: {
                    username: username,
                    password: password
                },
                success: function(response) {
                    var res = JSON.parse(response)
                    if (res.result) {
                        showAlert('success', res.message)
                        setTimeout(function() {
                            window.location.href = baseURL + '/App';
                        }, 1500)
                    } else {
                        showAlert('error', res.message)
                    }
                    console.log(res.message)
                },
            });
        });
    });
</script>