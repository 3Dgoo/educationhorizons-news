jQuery(document).ready(function() {
    let newsSearchTimeoutDelay = 500;
    let newsSearchTimeout = null;
    let newsSearchRequest = null;
    let newsSearchResultsContainer = jQuery('.news-search-results').first();
    let newsSearchPinnedContainer = jQuery('.news-search-results').first();

    jQuery('.news-search-form').on('submit', function(e) {
        e.preventDefault();
    });

    jQuery('.news-search-input').on('input', function(e) {
        let searchValue = jQuery(this).val();

        if (searchValue.length < 3) {
            return;
        }

        if (newsSearchRequest) {
            newsSearchRequest.abort();
        }

        clearTimeout(newsSearchTimeout);

        newsSearchTimeout = setTimeout(function() {
            newsSearchResultsContainer.html(
                '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>'
            );

            newsSearchRequest = jQuery.get({
                url: '/api/news-search',
                data: {
                    search: searchValue,
                },
                success: function(result) {
                    if (! result) {
                        newsSearchResultsContainer.html('No news found');
                    }

                    processNewsSearchData(result);
                },
                dataType: 'json'
            });
        }, newsSearchTimeoutDelay);
    });

    function processNewsSearchData(newsItems) {
        if (! newsItems.length) {
            newsSearchResultsContainer.html('No news found');
        }

        let content = '';

        jQuery.each(newsItems, function(i, newsItem) {
            content += '<div class="card my-3"><div class="card-body">' +
                '<h5 class="card-title">' + newsItem.title + '</h5>' +
                '<p class="text-secondary small mb-3">' + newsItem.published_at_nice + ' • ' + newsItem.publisher + '</p>' +
                '<a href="' + newsItem.link + '" class="btn btn-primary btn-sm" target="_blank">Read article</a>' +
                '</div></div>';
        });

        newsSearchResultsContainer.html(content);
    }
});
