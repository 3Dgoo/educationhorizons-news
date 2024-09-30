<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-bs-theme="dark"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>News Search</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <div class="container my-5">
            <h1 class="mb-5">News Search</h1>

            <form class="news-search-form mb-5">
                <div>
                    <label for="news-search-input" class="form-label">
                        Search
                    </label>

                    <input
                        id="news-search-input"
                        class="form-control news-search-input"
                        type="text"
                        name="search"
                        autocomplete="off"
                    />
                </div>
            </form>

            <div class="news-search-results"></div>

            <div class="news-search-pinned"></div>
        </div>

        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js" 
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
            crossorigin="anonymous"
        ></script>
        <script src="js/app.js"></script>
    </body>
</html>
