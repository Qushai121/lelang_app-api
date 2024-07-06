<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/js/app.js')
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div>
        <button onclick="senData()">
            Send Data
        </button>
    </div>

    <script>
        window.onload = function() {
            console.log('Initializing Echo...');
            console.log('Echo:', window.Echo);

            if (window.Echo) {
                console.log('Echo is initialized');
                window.Echo.channel(`message-sent-1`).listen("MessageSentEvents", (event) => {
                    // alert(event)
                    console.log(event);
                })
            } else {
                console.error('Echo is not initialized');
            }
        };

        function senData() {
            sendToCoba().then((data) => {
                console.log({
                    darisini: data
                });
            })
        }

        async function sendToCoba() {
            const resData = await axios.post("api/coba/1")
            return resData
        }
    </script>
    <script></script>
</body>

</html>
