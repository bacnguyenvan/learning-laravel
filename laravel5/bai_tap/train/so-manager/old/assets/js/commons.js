/* ハンバーガーメニュー開閉
============================*/
$(function() {
	//ナビメニューボタンの開く・閉じる
    $('#nav-menu-btn').on('click', function() {
        $('#nav-menu-btn span').toggleClass('typcn-th-menu');
        $('#nav-menu-btn span').toggleClass('typcn-times');
    });

	//ナビメニューボタンの「開く・閉じる」文字変更
	var flg = "default";
  	$('#my-menu-btn').click(function(){
    	if(flg == "default"){
      		$(this).text("マイメニューを閉じる");
      		flg = "changed";
    	}else{
      		$(this).text("マイメニューを開く");
      		flg = "default";
    	}
  	});
});

/* slick slider
============================*/
$(function() {
    $('.slider_1-1').slick({
          infinite: true,
          dots:true,
          arrows: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          responsive: [{
               breakpoint: 992,
                    settings: {
                         slidesToShow: 1,
                         slidesToScroll: 1,
               }
          }]
     });
    $('.slider_2-1').slick({
          infinite: true,
          dots:true,
          arrows: true,
          slidesToShow: 2,
          slidesToScroll: 2,
          responsive: [{
               breakpoint: 992,
                    settings: {
                         slidesToShow: 1,
                         slidesToScroll: 1,
               }
          }]
     });
    $('.info-slider_1-1').slick({
          infinite: true,
          dots: false,
          arrows: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          responsive: [{
               breakpoint: 992,
                    settings: {
                         slidesToShow: 1,
                         slidesToScroll: 1,
               }
          }]
     });
});

/* jquery.tablesorter（空き駐輪場検索）
============================*/
   $(document).ready(function() 
      { 
         $("#searchTable").tablesorter({
            sortList: [[0,0]]
         });
      } 
   ); 


/* 文字の拡大・縮小
============================*/
$(function() {
	//文字サイズ・大きく   
    $('#scale-control-area .btn-success').on('click', function() {
        $(this).toggleClass('d-none');
        $('#scale-control-area .btn-submit').toggleClass('d-none');
        $('#scale-control-area .btn-secondary').addClass('d-none');
        $('#scale-control-area .btn-cancel').removeClass('d-none');
        $('#font-scale').addClass('f-big');
        $('#font-scale').removeClass('f-bigger');
        $('#font-scale').removeClass('f-small');
    });
	//文字サイズ・さらに大きく   
    $('#scale-control-area .btn-submit').on('click', function() {
        $('#scale-control-area .btn-success').toggleClass('d-none');
        $('#font-scale').addClass('f-bigger');
        $('#font-scale').removeClass('f-big');
        $('#font-scale').removeClass('f-small');
    });
	//文字サイズ・小さく   
    $('#scale-control-area .btn-secondary').on('click', function() {
        $(this).toggleClass('d-none');
        $('#scale-control-area .btn-cancel').toggleClass('d-none');
        $('#font-scale').addClass('f-small');
        $('#font-scale').removeClass('f-bigger');
        $('#font-scale').removeClass('f-big');
    });
	//文字サイズ・元のサイズへ   
    $('#scale-control-area .btn-cancel').on('click', function() {
        $('#scale-control-area .btn-secondary').toggleClass('d-none');
        $('#font-scale').removeClass('f-bigger');
        $('#font-scale').removeClass('f-big');
        $('#font-scale').removeClass('f-small');
    });
});

/* ユーザー情報・入力分岐
============================*/
$(function() {
  //「利用者区分：一般」を選択→「勤務先」欄を表示  
    $('#user_categoryid_ippan').on('click', function() {
        $('.user_workplace_area').removeClass('d-none');
        $('.user_school_area').addClass('d-none');
        $('.user_graduate_area').addClass('d-none');
    });
  //「利用者区分：減免」を選択→「勤務先」欄を表示  
    $('#user_categoryid_genmen').on('click', function() {
        $('.user_workplace_area').removeClass('d-none');
        $('.user_school_area').addClass('d-none');
        $('.user_graduate_area').addClass('d-none');
    });
  //「利用者区分：学生」を選択→「学校名」「卒業予定」欄を表示  
    $('#user_categoryid_gakusei').on('click', function() {
        $('.user_school_area').removeClass('d-none');
        $('.user_graduate_area').removeClass('d-none');
        $('.user_workplace_area').addClass('d-none');
    });
});