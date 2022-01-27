$(function(){
    var $favorite = $('.btn-good'), //いいねボタンセレクタ
                favoriteId; //投稿ID
    $favorite.on('click',function(){
        var $this = $(this);
        //カスタム属性に格納された投稿ID取得
        favoriteId = $this.parents('.favorite').data('submission');
        $.ajax({
            type: 'POST',
            url: 'ajax_favorite.php', //post送信を受けとるphpファイル
            data: { submission_id: favoriteId} //{キー:投稿ID}
        }).done(function(data){
            console.log('Ajax Success');
            // いいね取り消しのスタイル
            $this.children('i').toggleClass('far');
              // いいね押した時のスタイル
            $this.children('i').toggleClass('fas');
            $this.children('i').toggleClass('active');
            $this.toggleClass('active');
        }).fail(function(msg) {
            console.log('Ajax Error');
        });
    });
});
