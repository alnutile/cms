$(document).ready(function(){


    //equal heights

    /* Thanks to CSS Tricks for pointing out this bit of jQuery
     http://css-tricks.com/equal-height-blocks-in-rows/
     It's been modified into a function called at page load and then each time the page is resized. One large modification was to remove the set height before each new calculation. */

    equalheight = function(container){

        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array(),
            $el,
            topPosition = 0;
        $(container).each(function() {

            $el = $(this);
            $($el).height('auto')
            topPostion = $el.position().top;

            if (currentRowStart != topPostion) {
                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
                rowDivs.length = 0; // empty the array
                currentRowStart = topPostion;
                currentTallest = $el.height();
                console.log(currentTallest);
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
            }
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    }

    $(window).load(function() {
        equalheight('.row.gallery_row .gallery_item .caption');
    });


    $(window).resize(function(){
        equalheight('.row.gallery_row .gallery_item .caption');
    });


    if($('body .ckeditor').length) {
        CKEDITOR.replace( '.ckeditor');
    }

    $('article').readmore({
        speed: 75,
        lessLink: '<a href="#">Read less</a>',
        collapsedHeight: 208
    });

	// changed by br 2016/01/22 to slow down changing image frames on silde display
    // Edited to put if statement around backstretch code. 3/25/2016 JB
    if(typeof(cms) !== 'undefined' && cms.home === 'home'){
    		$('body').addClass('home');
			$.backstretch(cms.slides, {
				fade: 750,
				duration: 5000     // br extend time from 2000 to 5000 ms
			});
    }
    
    //image galleries on projects
    $('a.gallery').colorbox({transition: "fade", maxWidth:"1200px", maxHeight:"1200px" });
    $('#colorbox').on("click", function(){
        $.colorbox.close();
    });
    $('a.gallery').colorbox({onComplete:function(){
        $("#cboxTitle").hide();
        $("#cboxLoadedContent").append($("#cboxTitle").html()).css({color: $("#cboxTitle").css("color")});
        $.fn.colorbox.resize();
    }})

    $('#top-button').on("click", function(){
        var data = $("body").data('top_menu');
        $.ajax({
            url: 'menus',
            type: 'POST',
            data: { 'data': data[0] },
            dataType: 'json'
        }).done(function(msg) {
            var n = noty({text: 'Your menu has been updated', type: 'success'});
        });
    });

    var group = $("ol.top-menu").sortable(
        {
            group: 'top-menu',
            onDrop: function  (item, targetContainer, _super) {
                var clonedItem = $('<li/>').css({height: 0})
                item.before(clonedItem)
                clonedItem.animate({'height': item.height()})

                item.animate(clonedItem.position(), function  () {
                    clonedItem.detach()
                    _super(item)
                });
                var data = group.sortable("serialize").get();

                $("body").data('top_menu', data);

            },
            onDragStart: function ($item, container, _super) {
                var offset = $item.offset(),
                    pointer = container.rootGroup.pointer

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                }

                _super($item, container)
            },
            onDrag: function ($item, position) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
                })
            }

        }
    );


});