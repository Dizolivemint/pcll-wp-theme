var InfiniteScroll = require('infinite-scroll');

$( document ).ready(function() {
    var infScroll = new InfiniteScroll( '.container', { 
        // options
        path: '.next'
    });
});


