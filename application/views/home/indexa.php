
<?php require_once 'headera.php'; ?>


<style>
	.mivideo{
		max-height:344px;
		max-width:640px;"
	}
	.latoken{
		margin-left:0px;
        max-width:250px;
        max-height:auto;
	}
    .icoholder{
        margin-left:0px;
        max-width:200px;
        max-height:auto;
    }
    .ussec{
        margin-left:0px;
        max-width:300px;
        max-height:auto;   
    }

	@media (max-width: 600px){
		.mivideo{
			max-height:177px;
			max-width:320px;	
		}
		.latoken{
			margin-left:-90px;
            max-width:300px;
            max-height:auto;
		}
        .icoholder{
            margin-left:-90px;
            max-width:150px;
            max-height:auto;
        }
        .ussec{
            margin-left:0px;
            max-width:200px;
            max-height:auto;   
        }
	}
    #total_sales{
        float:right;
    }
    .ico-text-block{
        width:70%;
    }
    .ico-value-block{
        width:30%;   
    }
</style>

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-up"></i>

</button>

<div id="home" class="home flex">
    <div id="particles-js" class="particles-container particles-js"></div>
    <div class="home-text animated fadeInUp d125" style="font-size: 35px;">

        <div class="licences fadeInUp d025">
            <a href=" https://www.sec.gov/cgi-bin/browse-edgar?CIK=0001770394&owner=exclude&action=getcompany&Find=Search" target="blank">
                <img class="ussec" border="0" src="assets/ussec.png"/>
            </a>
        </div>
        <h3><?php echo $t['mainmsg']?></h3>
        

        <div class="partners fadeInUp d025">
            
                <a href="https://docs.google.com/document/d/1UuhSz6dlhP1EH5DCp0gpidzfL_Lr9Y2QTjgY5hHvJUg/edit" target="_blank">
                    <img class="latoken" border="0" src="assets/latoken_black.png"/>
                </a>

                <a href="https://icoholder.com/es/socialremit-blockchain-networks-ltd" target="_blank">
                    <img class="icoholder" border="0" src="assets/icoholder2.png"/>
                </a>
            
        </div>
    </div>

    <div class="ico animated fadeInUp">
        <span class="ico-title"><?= $t['chrono_airdrop'] ?></span>
        <div id="counter" class="counter flex">
            <div class="counter-wrapper">
                <div id="counter_d" class="counter-block">--</div>
                <span class="counter-tag"><?= $t['days_lab'] ?></span>
            </div>
            <div class="counter-wrapper">
                <div id="counter_h" class="counter-block">--</div>
                <span class="counter-tag"><?= $t['hours'] ?></span>
            </div>
            <div class="counter-wrapper">
                <div id="counter_m" class="counter-block">--</div>
                <span  class="counter-tag"><?= $t['minutes'] ?></span>
            </div>
            <div class="counter-wrapper">
                <div id="counter_s" class="counter-block">--</div>
                <span class="counter-tag"><?= $t['seconds'] ?></span>
            </div>
        </div>
        <div class="ico-text flex">
            <div class="ico-text-block left">
                <?= $t['a_asignados'] ?> 
            </div>
            <div class="ico-value-block right">
                <?=number_format($total_sales)?>
            </div>
        </div>
        <div class="ico-text flex">
            <div class="ico-text-block left">
                <?= $t['a_totales'] ?> 
            </div>
            <div class="ico-value-block right">
                <?=number_format($total_token_sales)?>
            </div>
        </div>
        <div class="ico-text flex">
            <div class="ico-text-block left">
                <?= $t['a_pct'] ?> 
            </div>
            <div class="ico-value-block right">
                <?=round($total_sales/$total_token_sales*100,2)?> %
            </div>
        </div>
        
        <ul class="ico-buttons">
            <ul class="btn-counter">

                <li><a href="/login?redirect=ico-purchase"><div class="ico-buy" style="background-color: #F00;color:#fff;"><?= $t['btn_participate'] ?></div></a></li>
                
                <li><a href="whitepaper.php"><div class="ico-whitepaper">WHITEPAPER</div></a></li>
            </ul>
            
        </ul>
    </div>
</div>

<script>
$("#btnstats").click(function(){
    var display =  $("#flagstats").css("display");
    if(display!="none")
    {
        $("#flagstats").attr("style", "display:none");
    }else{
        $("#flagstats").attr("style", "display:show");
    }
});
</script>
<?php require_once 'footera.php'; ?>