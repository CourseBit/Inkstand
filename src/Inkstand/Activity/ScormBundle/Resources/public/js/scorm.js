
$(document).ready(function() {
    var $scormEmbed = $("iframe.scorm-embed");
    $scormEmbed.css("display", "block");

    resizeScorm($scormEmbed);

    $(window).resize(function() {
        resizeScorm($scormEmbed);
    });
});

function resizeScorm($scormIframe) {
    var documentHeight = $(window).height();
    var documentWidth = $(window).width();
    var offset = $scormIframe.offset();

    $scormIframe.width(documentWidth - offset.left);
    $scormIframe.height(documentHeight - offset.top);
}