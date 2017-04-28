jQuery(document).ready(function($){
    $('#trie-button button').click(function(){
        var that = $(this);
        //Pour etre sur on vire le active dans la class.
        var thatClass = that.attr('class').replace(' active','');
        if(thatClass == 'all'){
            $('.item_batiment').show();
        }else{
            $('.item_batiment').hide();
            $("div[data-type='"+thatClass+"']").show();
        }
        $('#trie-button button').removeClass('active');
        that.addClass('active');
    });
});


