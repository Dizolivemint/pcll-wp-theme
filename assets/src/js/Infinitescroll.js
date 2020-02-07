$( document ).ready(function() {
    $('.container').infiniteScroll({
        // options
        path: '.next',
        append: '.product',
        checkLastPage: true,
        responseType: 'document'
    });
});


