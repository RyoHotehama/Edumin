//削除ポップアップ
$(function(){
  $(".delete_tag").on("click", function(){
    if(confirm('削除しますか？')){
    } else {
      return false;
    }
  });
});
