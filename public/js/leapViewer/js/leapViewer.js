$(document).ready(function() {

    var url = "http://localhost/artaddict/public/js/leapViewer/";
    
    $(".eProductHeroImg").on("click", function(e) {
        e.preventDefault();
        
        var self = $(this);
        var id = self.parents(".bContentProduct").children(".bProductInfo").data('id');
        var imgObj = ({
            url: self.attr('href'), 
            id: id,
            top: self.children('.product_image_thumb').position().top, 
            left: self.children('.product_image_thumb').position().left, 
            width: self.children('.product_image_thumb').width(), 
            height: self.children('.product_image_thumb').height()
        });
        
        if(findView(id)) {
            viewClose(imgObj);
        } else {
            viewOpen(imgObj);
        }
    });
    
    $('body').on({
        mouseenter: function () {
            var image = $(this).children(".image_control_close");
            $(image).css("visibility","visible");
        },
        mouseleave: function () {
            var image = $(this).children(".image_control_close");
            $(image).css("visibility","hidden");
        }
    }, ".leapview_container");
    
    $('body').on('click', '.image_control_close', function() {
        var imgOrigin = $(this).parent();
        var originObj = ({
            id: imgOrigin.data('id'),
            top: imgOrigin.data('top'),
            left: imgOrigin.data('left'),
            width: imgOrigin.data('width'),
            height: imgOrigin.data('height')
        });
        viewClose(originObj);
    });
    
    function viewOpen(imgParams, callback) {
        if(imgParams.width<imgParams.height){
            var viewScale = ($(window).height()*0.71)/imgParams.height;
        } else {
            var viewScale = ($(window).width()*0.53)/imgParams.width;
        }
        var viewWidth = imgParams.width*viewScale;
        var viewHeight = imgParams.height*viewScale;
        var viewLeft = (Math.floor(window.innerWidth/2))-(viewWidth/2);
        var viewTop = ($(window).scrollTop() + $(window).height() / 2)-(viewHeight/2);

        $("body").append('<div data-id="' + imgParams.id + '" data-width="' + imgParams.width + '" data-height="' + imgParams.height + '" data-left="' + imgParams.left + '" data-top="' + imgParams.top + '" class="leapview_container" id="leapview_container_' + imgParams.id + '" style="cursor: move; z-index: 300; position: absolute; left:' + imgParams.left + 'px; top:' + imgParams.top + 'px;"><img id="leapview_image_' + imgParams.id + '" src="' + imgParams.url + '" /><img class="image_control_close" id="image_control_close_' + imgParams.id + '" style="position: inherit; left:-15px; top:-14px; cursor:pointer; visibility: hidden; display:none;" src="' + url + 'assets/images/closebox.png" /></div>');
        $("#leapview_image_" + imgParams.id).width(imgParams.width);
        $("#leapview_image_" + imgParams.id).height(imgParams.height);
        
        $("#leapview_image_" + imgParams.id).animate({left:viewLeft, top:viewTop, width:viewWidth, height:viewHeight});
        $("#leapview_container_" + imgParams.id).animate({left:viewLeft, top:viewTop, width:viewWidth, height:viewHeight}, function(){
            var closeBtn = $(this).children(".image_control_close");
            $(closeBtn).css("display","inline");
            if (typeof callback == 'function') {
                callback.call(this);
            }
        });
    }
    
    function viewClose(imgParams, callback) {
        $("#leapview_image_" + imgParams.id).animate({width:imgParams.width, height:imgParams.height});
        
        var closeBtn = $("#leapview_container_" + imgParams.id).children(".image_control_close");
        closeBtn.css("display","none");
        
        $("#leapview_container_" + imgParams.id).animate({left:imgParams.left, top:imgParams.top, width:imgParams.width, height:imgParams.height}, function(){
            $("#leapview_container_" + imgParams.id).remove();
            if (typeof callback == 'function') {
                callback.call(this);
            }
        });
    }
    
    function findView(viewId) {
        if($("#leapview_container_" + viewId).length) {
            return 1;
        } else {
            return 0;
        }
    }
    
});

