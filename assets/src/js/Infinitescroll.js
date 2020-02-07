$( document ).ready(function() {
    $('.container').infiniteScroll({
        // options
        path: '.next.page-numbers',
        append: '.product',
        checkLastPage: true,
        responseType: 'document'
    });
});


