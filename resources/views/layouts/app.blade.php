<!DOCTYPE html>
<html>
    <head>
        <title>Order Fulfillment with Fetchr</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="//cdn.shopify.com/s/assets/external/app.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/uptown.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        @yield('styles')
        <script type="text/javascript">

ShopifyApp.init({
    apiKey: "{{ env('SHOPIFY_APIKEY') }}",
    shopOrigin: '{{ "https://{$shop}" }}'
});

        </script>

        <script type="text/javascript">

            ShopifyApp.ready(function () {

                ShopifyApp.Bar.initialize({

                    icon: '',
                    title: 'Fetchrify',
                    buttons: {
                        primary: {
                            label: 'Help',
                            message: 'Help'
                        }
                    }

                });

            });

        </script>
    </head>
    <body>

        <main>
            <article>
                <div class="columns twelve card has-sections tabs-container">
                    <ul class="tabs">
                        <li class="active"><a href="#orders">Orders</a></li>
                        <li><a href="#settings">Settings</a></li>
                    </ul>
                </div>
            </article>
            @yield('content')
        </main>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" 
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        @yield('scripts')
        <script>
            $(document).ready(function () {
                //Handling tabs click event
                $('ul.tabs li').click(function () {

                    var tab_id = $(this).children().attr('href');

                    $('ul.tabs li').removeClass('active');
                    $('.tab-content').removeClass('current');

                    $(this).addClass('active');
                    $(tab_id).addClass('current');
                });
            });
        </script>
    </body>
</html>