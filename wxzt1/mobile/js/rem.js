(function () {
        var $html=$('html');
        var $window=$(window);
        var $body=$("body");
        var psdsize=parseInt($body.attr('data-psd-width'));
        var htmlfont=$body.width()/psdsize*100+'px';
        $html.css('font-size',htmlfont);
        $body.css('opacity',1);
        $window.resize(function () {
                htmlfont=$body.width()/psdsize*100+'px';
                $html.css('font-size',htmlfont)
        });
})()

