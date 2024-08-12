$(document).ready(function(){
    var showMore = false;

    $('.more-info').on('click', function(){
        showMore = !showMore;
        var text = $(this).find('.text');
        var icon = $(this).find('i');
        if(showMore){
            $('.banner-content__desc').css({"-webkit-line-clamp": "unset"});
            icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            text.text('Thu gọn giới thiệu');
        }else{
            $('.banner-content__desc').css({"-webkit-line-clamp": "3"});
            icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            text.text('Hiển thị thêm');
        }

    });
    
    function eposodeSelection(){
        $('.paginate-eposode-list').toggle();
    }

    $(document).on('click', '.episodes-page .page-tab-content', function(){
        eposodeSelection();
    });
     
})