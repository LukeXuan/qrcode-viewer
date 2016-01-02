/**
 * Created by Luke.Lazurite on 12/31/2015.
 */

(function() {

    console.log("Activated");

    jQuery("document").ready(function () {
        jQuery(".page-title").each(function(index, container) {
            var title = jQuery(container).find(".row-title").html();

            container = jQuery(container).find(".row-actions");
            var view = container.find(".view");
            var url = view.find("a").attr("href");
            var image = jQuery("<div>");
            var imageElement = image[0];
            var qrcode = new QRCode(imageElement, {
                width: 100,
                height: 100
            });
            qrcode.makeCode(url);

            console.log(l10n);
            console.log(window.l10n);

            var link = jQuery("<span>", {"class": "qrcode"})
                .append(jQuery("<a>", {
                    "title": l10n["download-qrcode"],
                    "download": title+".png"})
                    .text(l10n["qrcode"])
                );

            link.find("a")
                .hover(function() {
                    jQuery(this).append(image).attr("href", image.find("img").attr("src"));
                }, function() {
                    image.remove();
                });

            container.children().last().append(" | ");
            container.append(link);
        })
    });

})();