$( document ).ready(function() {
    $('.wp-block-gallery').each(function() {
        $(this).find('figure').each(function (){
            //we need the img url, make sure we dont get the lazyloading placeholder img
            let imgElem = $(this).find('img');
            let imgUrl;
            if(imgElem.data("src")){
                imgUrl = imgElem.data("src");
            }else{
                imgUrl = imgElem.attr('src');
            }
            //construct Webflow JSON lightbox object
            let lightboxObj = "{\"items\":[{\"type\":\"image\",\"url\":\""+imgUrl+"\"}],\"group\": \"lightboxgroup1\"}";

            //wrap the figure in an anchor that will open Webflow's lightbox
            let lightboxAnchor = $(this).wrap('<a href="#" class=\"lightbox-link w-inline-block w-lightbox"></a>').parent();

            //append the JSON obj to the lightbox anchor so Webflow know what img to open
            lightboxAnchor.append("<script type=\"application/json\" class=\"w-json\">"+ lightboxObj +"</script>");
        });
    });
});
