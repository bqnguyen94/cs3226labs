function notDisplay(){
    jQuery('body').css('display','none');
}

jQuery(document).ready(function(){
    jQuery('body').fadeIn();
    jQuery('a').on('click',function(event){
        var thetarget = this.getAttribute('target')
        if (thetarget!="_blank"){
            var theherf=this.getAttribute('href')
            if(!theherf.include('#')){
                event.preventDefault();
                jQuery('body').fadeOut(function(){
                    window.location=theherf
                });
            }
        }
    });
});