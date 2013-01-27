
jQuery(document).ready(function(){
    jQuery.ajax({
        url:'http://themullers.org/mike/wp-content/plugins/goodreads-widget/goodreads-widget-content.php',
        dataType:'html'}
    ).done(function(data) {
        jQuery('#goodreads-content').replaceWith(data);
    });
});
