
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>相册</title>
	<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.js"></script>
	<script src="jquery.easing.1.3.js" type="text/javascript"></script>  
    <link type="text/css" rel="stylesheet" href="styles/default.css" media="screen" />
    <link rel="Stylesheet" type="text/css" href="styles/loginDialog.css" />
	<script type="text/javascript">
		$(document).ready(function() {
		
			$curtainopen = false;
		
			$(".rope").click(function(){
				$(this).blur();
				if ($curtainopen == false){ 
					$(this).stop().animate({top: '0px' }, {queue:false, duration:350, easing:'easeOutBounce'}); 
					$(".leftcurtain").stop().animate({width:'60px'}, 2000 );
					$(".rightcurtain").stop().animate({width:'60px'},2000 );
					$curtainopen = true;
				}else{
					$(this).stop().animate({top: '-40px' }, {queue:false, duration:350, easing:'easeOutBounce'}); 
					$(".leftcurtain").stop().animate({width:'50%'}, 2000 );
					$(".rightcurtain").stop().animate({width:'51%'}, 2000 );
					$curtainopen = false;
				}
				return false;
			});
			
		});	
	</script>
	<style type="text/css">
	    *{
	    	margin:0;
	    	padding:0;
	    }
	    body {
	    	text-align: center;
	    	background: #4f3722 url('images/darkcurtain.jpg') repeat-x;
	    }
	    img{
			border: none;
		}
	    .leftcurtain{
			width: 50%;
			height: 515px;
			top: 0px;
			left: 0px;
			position: absolute;
			z-index: 2;
		}
		 .rightcurtain{
			width: 51%;
			height: 515px;
			right: 0px;
			top: 0px;
			position: absolute;
			z-index: 3;
		}
		.rightcurtain img, .leftcurtain img{
			width: 100%;
			height: 100%;
		}
		.logo{
			margin: 0px auto;
			margin-top: 150px;
		}
		.rope{
			position: absolute;
			top: -40px;
			left: 70%;
			z-index: 4;
		}
	   .xiangce{
            position: absolute;
            z-index: -1;
        }
        .login{
            position: absolute;
            z-index: 5;
             background:#B8B8B8;
            width: 100%;
            height: 100%;
        }
        .ipt{
            width: 30;
            height: 10;
        }
	</style>
</head>

<body>
    <?php
        $renzheng = $_POST['log'];
        if($renzheng != "种菜的"){
        echo '

    <div class="login">
           <form class="theme-signin" name="loginform" action="" method="post">
                <ol>
                    <li>&nbsp</li>
                    <p>&nbsp</p>
                     <li><h4 color="yellow">你必须先认证！</h4></li>
                     <li><strong>口令：</strong><input class="ipt" type="text" id="log" name="log" placeholder="果果的姑父家是做什么的？" size="30" ></li>
                     <li><input class="btn btn-primary" type="submit" name="submit" value=" 认 证 "></li>
                </ol>
           </form>
     </div>
     ';
    }

        
        unset($renzheng);
    ?>
	<div   class="leftcurtain"><img src="images/frontcurtain.jpg"/></div>
	<div   class="rightcurtain"><img src="images/frontcurtain.jpg"/></div>
        <a  class="rope" href="#">
            <img  src="images/rope.png"/>
        </a>       
    <div class="xiangce"> 
        <ul  id="images">
            <li><div>
                <a href="3dOcean.htm"><img alt="xiaowang1" src="images/thumbnails/xiaowang1.jpg"/></a>
            </div></li>
            <li><div>
                <a href="AudioJungle.htm"><img alt="guoguo1" src="images/thumbnails/guoguo1.jpg"/></a>
            </div></li>
            <li><div>
            <a href="ActiveDen.htm"><img alt="guoguo2" src="images/thumbnails/guoguo2.jpg"/></a>
            </div></li>
           
        </ul>
    </div>
    <script src='js/jqueryui-core-drag.js'></script>        
    <script type="text/javascript">     
//* 
    var imgs;
        
    $(document).ready(function () {
    var drag = {};
        $('h1').remove();
        $('#images').append('<li id="instructions"><h4>欢迎来到果果家的相册!</h4></li>');
        
        imgs = $("#images li");

        imgs.draggable({ 
            stack : { group : '#images li', min : 1},
            start : function () {
                $this = $(this);
                if($this.attr('id') === 'instructions') { $this.fadeOut().remove(); }
                
                imgs.each(function () {
                    var $this = $(this);
                    if($this.width() !== 256) {
                        $this.stop().animate({width : 256 }).removeClass('top');
                    }
                });
                
                drag.startTime = new Date();
                drag.startPos = $this.position();
            },
            stop : function () {
                var $this = $(this), top, left, time;
                drag.endTime = new Date();
                drag.endPos = $this.position();
                drag.leftOffset = drag.endPos.left - drag.startPos.left;
                drag.topOffset  = drag.endPos.top  - drag.startPos.top;

                time = (drag.endTime.getTime() - drag.startTime.getTime()) /60;
                
                top  = (drag.topOffset / time).toString();
                left = (drag.leftOffset / time).toString();
                
                $this.animate({
                    top : '+=' + top, 
                    left: '+=' + left 
                });
            }
        });

        imgs.click(function () {
            var $this = $(this);
        
            if ($this.attr('id') == 'instructions') {
                $this.fadeOut().remove();
            }
            else {
                if($this.width() !== 256) {
                    $this.stop().animate({width : 256 }).removeClass('top');
                }
                else {
                    if (!($this.find('.info').length)) {
                        $.ajax({
                            url : $this.find('a').attr('href'),
                            dataType : 'html',
                            success : function (data) {
                                var $d = $(data),
                                    head = $d.filter('h1'),
                                    para = $d.filter('p');
                                    
                                $this.children('div').append('<div class="info"></div>').find(".info").append(head, para);
                            },
                            error : function () {
                                var msg = '<h1>Oops!</h1><p>It looks like there been a problem; we can\'t get this info right now.</p>';
                                $this.children('div').append('<div class="info"></div>').find(".info").html(msg);
                            }
                        });
                    }
                    $this.css({'zIndex' :8 })
                             .stop()
                             .animate({ width : 512})
                             .addClass('top')
                                .siblings().removeClass('top')
                                           .stop()
                                           .animate({width : 256})
                                                .filter(function () { return $(this).css('zIndex') >= '8' }).css({'zIndex' : 7});
                }
            }
            return false;
        });
        
    });

$(window).load(function () {
    $w = $(window);
    imgs.css({
            position : 'absolute',
            left : $w.width() / 2 - imgs.width(),
            top  : $w.height() / 2- imgs.height()
        });
    for(var i = 0; imgs[i]; i++ ) {
        $(imgs[i]).animate({
                left : '+=' + Math.random()*150,
                top  : '+=' + Math.random()*150
            });
    }
});//*/
</script>
</body>
</html>
