jQuery(document).ready(function($){
    $('.btabsE').on('click',function(){
        var id = $(this).attr('data-tabs');
        if(id == 'all'){
            $('.sTabs').each(function(){
                $(this).show();
            });
        }else{
            $('.sTabs').each(function(){
                $(this).hide();
            });
            $('.sTabs-'+id).show();
        }
    });


    $('#trie-button button').click(function(){
        var that = $(this);


        $('#trie-button button').removeClass('active');
        that.addClass('active');
    });
});