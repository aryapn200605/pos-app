<script>
    $(document).ready(function() {
        const app = {
            containerModule: '#container-module',

            goToModule(url) {
                if (url === "#") url = "/app/home";

                if (url === "/auth/logout") {
                    alertify.confirm(
                        'Logout',
                        'Logout of your account?',
                        () => {
                            this.ajaxModule(baseURL + url);
                            window.location.href = `${baseURL}/Auth`;
                        },
                        () => {
                            console.log('Logout canceled');
                        }
                    );
                } else {
                    this.ajaxModule(baseURL + url);
                }
            },

            traversedHrefLink() {
                $(".menu").off('click').on('click', function(e) {
                    const url = $(this).attr('href');
                    app.goToModule(url);
                    e.preventDefault();
                    e.stopPropagation();
                });
            },

            ajaxModule(url) {
                const container = this.containerModule;

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "html",
                    success: (res) => {
                        console.log(`Loaded ${url}`);
                        $(container).html(res);
                    },
                    beforeSend: () => {
                        console.log(`Loading module ${url}`);
                    },
                    error: (xhr, status, error) => {
                        console.error(`Failed to load module: ${error}`);
                    }
                });
            },

            setTitle(title) {
                $('#page-title').html(title)
            }
        };

        app.goToModule('/app/home')

        app.traversedHrefLink();
        window.app = app;

        $('#brand-navbar').on('click', function() {
            app.goToModule('/app/home');
        });
    })
</script>