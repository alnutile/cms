$(document).ready(function(){
    if($('body .ckeditor').length) {
        CKEDITOR.replace( '.ckeditor');
    };

    //image galleries on projects
    $('a.gallery').colorbox({transition: "fade", Maxwidth:"1200px" });
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