jQuery(function(){

    jQuery('select[name=skudler_site_id]').change(function(){
        if(jQuery(this).val() != siteId){
            jQuery('#eventsLocked').show();
            jQuery('#eventsSetting').hide();
        }else{
            jQuery('#eventsLocked').hide();
            jQuery('#eventsSetting').show();
        }
    });

});
