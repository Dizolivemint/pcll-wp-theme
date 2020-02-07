var InfiniteScroll = require('infinite-scroll');

$( document ).ready(function() {
    var infScroll = new InfiniteScroll( '.products', { 
        // options
        path: '.next',
        append: '.products',
        history: 'false',
        checkLastPage: true,
        responseType: 'document',
        hideNav: '.woocommerce-pagination'
    });
});


